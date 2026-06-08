<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'Iwan Fals - Tikus-Tikus Kantor',
                'description' => 'Ayo bernyanyi bersama di konser akbar kami bersama penyanyi legendaris kita dalam rangka naiknya mata uang rupiah tertinggi dalam sejarah indonesia',
                'category' => 'konser',
                'date' => '2026-07-06',
                'time' => '15:00:00',
                'location' => 'Stadion Pakansari - Bogor',
            ],
            [
                'title' => 'Laravel - Framework Untuk Website',
                'description' => 'Membuat projek web sederhana dengan MVC arsitektur dengan framework laravel',
                'category' => 'workshop',
                'date' => '2026-07-06',
                'time' => '12:00:00',
                'location' => 'Auditorium lt.3, gedung CCIT-FTUI - Depok',
            ],
        ];
        foreach($data as $event){
            Event::factory()->create($event);
        }
    }
}
