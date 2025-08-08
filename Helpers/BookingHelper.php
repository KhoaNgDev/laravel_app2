<?php

namespace App\Helpers;

use Carbon\Carbon;

class BookingHelper
{
    public static function generateSlotTimes(Carbon $start, int $count): array
    {
        $times = [];
        for ($i = 0; $i < $count; $i++) {
            $times[] = $start->copy()->addMinutes($i * 20)->format('H:i:s');
        }
        return $times;
    }

    public static function isWithinWorkingHours(Carbon $datetime): bool
    {
        $day = $datetime->dayOfWeek; 
        $time = $datetime->format('H:i:s');

        if ($day === 0) return false; 

        if ($day === 6) {
            return $time >= '08:00:00' && $time < '12:00:00';
        }

        return $time >= '08:00:00' && $time < '20:00:00';
    }
}
