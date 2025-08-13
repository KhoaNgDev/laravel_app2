<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Log;

// Khởi tạo kernel
$kernel = $app->make(Kernel::class);

try {
    $kernel->call('schedule:run');
    Log::info('[Cron] Scheduler chạy thành công lúc ' . now());
} catch (\Exception $e) {
    Log::error('[Cron] Lỗi khi chạy scheduler: ' . $e->getMessage());
}
