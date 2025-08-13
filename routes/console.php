<?php


use Illuminate\Support\Facades\Schedule;



Schedule::command('bookings:cancel-expired')
    ->dailyAt('09:00')
    ->withoutOverlapping()
    ->onOneServer();