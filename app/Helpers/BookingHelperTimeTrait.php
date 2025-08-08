<?php

namespace App\Helpers;

use Carbon\Carbon;

trait BookingHelperTimeTrait
{
    public function generateTimeSlotsForDay($date)
    {
        $tz = 'Asia/Ho_Chi_Minh';
        $carbon = Carbon::parse($date, $tz);

        $slots = [];

        $start = Carbon::createFromFormat('Y-m-d H:i', "$date 08:00", $tz);
        $end = $carbon->isSaturday()
            ? Carbon::createFromFormat('Y-m-d H:i', "$date 12:00", $tz)
            : Carbon::createFromFormat('Y-m-d H:i', "$date 20:00", $tz);

        while ($start < $end) {
            $slots[] = $start->format('H:i');
            $start->addMinutes(20);
        }

        return $slots;
    }

    public function withinWorkingHours(Carbon $time)
    {
        $time->setTimezone('Asia/Ho_Chi_Minh'); 

        $day = $time->dayOfWeek;
        $hour = (int) $time->format('H');
        $minute = (int) $time->format('i');

        if ($day === 0) return false;

        if ($day === 6 && ($hour > 12 || ($hour === 12 && $minute > 0))) return false;

        if ($hour < 8 || $hour >= 20) return false;

        return true;
    }
    
}
