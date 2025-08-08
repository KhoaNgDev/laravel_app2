<?php
namespace App\Exports;

use App\Models\Booking;
use App\Models\MstCustomer;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookingsExport implements FromQuery, WithHeadings, WithMapping, Responsable
{
    use Exportable;

    public string $fileName = 'export_booking.xlsx';
    protected ?Request $request;

    public function __construct(?Request $request = null)
    {
        $this->request = $request;
    }

 public function query()
{
    $query = Booking::query()->with(['customer', 'technician', 'service', 'slots']);

    if ($this->request->filled('customer')) {
        $query->whereHas('customer', function ($q) {
            $q->where('customer_name', 'like', '%' . $this->request->customer . '%');
        });
    }

    if ($this->request->filled('date')) {
        $query->whereHas('slots', function ($q) {
            $q->whereDate('start_time', $this->request->date);
        });
    }

    if ($this->request->filled('technician_id')) {
        $query->where('technician_id', $this->request->technician_id);
    }

    if ($this->request->filled('status')) {
        $query->where('status', $this->request->status);
    }

    return $query;
}

    public function headings(): array
    {
        return [
            'ID',
            'Khách hàng',
            'Dịch vụ',
            'Thợ',
            'Thời gian làm',
            'Trạng thái',
        ];
    }


    public function map($row): array
    {
        $slots = $row->slots->sortBy('start_time');

        
        if ($slots->count()) {
            $start = Carbon::parse($slots->first()->start_time);
            $end = Carbon::parse($slots->last()->end_time);
            $slotText = $start->format('d/m/Y H:i') . ' - ' . $end->format('H:i');
        } 
        else {
            $slotText = 'Chưa đặt lịch';
        }

        return [
            $row->id,
            $row->customer->customer_name ?? 'Không có',
            $row->service->service_name ?? 'Không có',
            $row->technician->name ?? 'Chưa phân công',
            $slotText,
            $this->translateStatus($row->status),
        ];
    }


    protected function translateStatus(string $status): string
    {
        return match ($status) {
            'confirmed' => 'Đã xác nhận',
            'completed' => 'Hoàn thành',
            'canceled' => 'Đã huỷ',
            default => 'Không rõ',
        };
    }
}
