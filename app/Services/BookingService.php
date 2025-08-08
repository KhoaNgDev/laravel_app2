<?php

namespace App\Services;

use App\Helpers\BookingHelperTimeTrait;
use App\Models\Booking;
use App\Models\BookingSlot;
use App\Models\Customer;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingService
{
    use BookingHelperTimeTrait;

    public function setupBooking($request)
    {
        DB::beginTransaction();
        try {
            $customer = $this->createOrGetCustomer($request);

            $start = Carbon::createFromFormat('Y-m-d H:i', $request->booking_date . ' ' . $request->booking_time, 'Asia/Ho_Chi_Minh');
            $duration = Service::find($request->service_id)->duration ?? 20;
            $end = (clone $start)->addMinutes($duration);
            if (!$this->withinWorkingHours($end)) {
                return [
                    'status' => false,
                    'message' => 'Thời gian kết thúc vượt quá giờ làm việc. Vui lòng chọn khung giờ sớm hơn.'
                ];
            }

            $neededSlots = $this->generateNeededSlots($start, $end);
            $technicians = User::where('group_role', 'User')->get();

            foreach ($technicians as $technician) {
                if ($this->hasTechnicianConflict($technician->id, $neededSlots)) {
                    continue;
                }

                if (!$this->slotsAreAvailable($neededSlots)) {
                    continue;
                }

                $booking = Booking::create([
                    'customer_id' => $customer->id,
                    'technician_id' => $technician->id,
                    'service_id' => $request->service_id,
                    'booking_start' => $start,
                    'booking_end' => $end,
                    'status' => 'confirmed',
                ]);

                foreach ($neededSlots as [$slotStart, $slotEnd]) {
                    BookingSlot::create([
                        'booking_id' => $booking->id,
                        'technician_id' => $technician->id,
                        'date' => $slotStart->toDateString(),
                        'start_time' => $slotStart->format('H:i:s'),
                        'end_time' => $slotEnd->format('H:i:s'),
                    ]);
                }

                DB::commit();
                return ['status' => true, 'booking' => $booking];
            }

            DB::rollBack();
            return ['status' => false, 'message' => 'Không còn slot trống phù hợp.'];
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Booking error', ['error' => $e->getMessage()]);
            return ['status' => false, 'message' => 'Lỗi hệ thống.'];
        }
    }

    public function getAvailableTimes($date, $serviceId)
    {
        $service = Service::find($serviceId);
        if (!$date || !$service)
            return [];

        $duration = $service->duration ?? 20;
        $slotUnit = 20;

        $workingSlots = $this->generateTimeSlotsForDay($date);
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $available = [];

        foreach ($workingSlots as $start) {
            $slotStart = Carbon::parse("$date $start", 'Asia/Ho_Chi_Minh');
            $slotEnd = (clone $slotStart)->addMinutes($duration);

            if ($slotStart->lessThan($now))
                continue;
            if (!$this->withinWorkingHours($slotEnd))
                continue;
            if (!$this->withinWorkingHours($slotStart))
                continue;

            $valid = true;
            $checkTime = clone $slotStart;
            while ($checkTime < $slotEnd) {
                $checkEnd = (clone $checkTime)->addMinutes($slotUnit);

                $count = BookingSlot::where('date', $date)
                    ->where('start_time', $checkTime->format('H:i:s'))
                    ->where('end_time', $checkEnd->format('H:i:s'))
                    ->whereHas('booking', fn($q) => $q->where('status', '!=', 'canceled'))
                    ->count();

                if ($count >= 2) {
                    $valid = false;
                    break;
                }

                $checkTime = $checkEnd;
            }

            if ($valid) {
                $available[] = $start;
            }
        }

        return $available;
    }


    protected function createOrGetCustomer($request)
    {
        return Customer::firstOrCreate(
            ['customer_email' => $request->customer_email],
            ['customer_name' => $request->customer_name, 'customer_phone' => $request->customer_phone]
        );
    }

    protected function generateNeededSlots(Carbon $start, Carbon $end)
    {
        $slots = collect();
        $temp = clone $start;

        while ($temp < $end) {
            $slotEnd = (clone $temp)->addMinutes(20);
            $slots->push([$temp->copy(), $slotEnd]);
            $temp = $slotEnd;
        }

        return $slots;
    }

    protected function hasTechnicianConflict($technicianId, $slots)
    {
        foreach ($slots as [$slotStart, $slotEnd]) {

            $conflict = BookingSlot::where('technician_id', $technicianId)
                ->where('date', $slotStart->toDateString())
                ->where('start_time', $slotStart->format('H:i:s'))
                ->where('end_time', $slotEnd->format('H:i:s'))
                ->whereHas('booking', fn($q) => $q->where('status', '!=', 'canceled'))
                ->exists();

            if ($conflict) {
                return true;
            }
        }

        return false;
    }

    protected function slotsAreAvailable($slots)
    {
        foreach ($slots as [$slotStart, $slotEnd]) {
            $count = BookingSlot::where('date', $slotStart->toDateString())
                ->where('start_time', $slotStart->format('H:i:s'))
                ->where('end_time', $slotEnd->format('H:i:s'))
                ->whereHas('booking', fn($q) => $q->where('status', '!=', 'canceled'))
                ->count();

            if ($count >= 2) {
                return false;
            }
        }

        return true;
    }
}
