<?php


use Illuminate\Support\Facades\Schedule;



Schedule::command('maintenance:remind')
    ->everyMinute()
    ->withoutOverlapping()
    ->onOneServer();