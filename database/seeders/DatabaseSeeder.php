<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Thêm các model cần seed
use App\Models\User;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Booking;
use App\Models\TimeSlot;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Service::insert([
            
            ['service_name' => 'Thay nhớt', 'description' => 'Thay nhớt định kỳ', 'duration' => 30],
            ['service_name' => 'Thay bugi', 'description' => 'Thay bugi mới', 'duration' => 20],
            ['service_name' => 'Sửa phanh', 'description' => 'Sửa chữa phanh xe', 'duration' => 45],
            ['service_name' => 'Bảo dưỡng tổng quát', 'description' => 'Kiểm tra tổng thể xe', 'duration' => 60],
            ['service_name' => 'Rửa xe và làm sạch', 'description' => 'Vệ sinh toàn bộ xe', 'duration' => 15],
        ]);

        User::factory(30)->create();

    }
}
