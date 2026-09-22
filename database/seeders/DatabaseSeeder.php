<?php

namespace Database\Seeders;

use App\Models\SiteContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach ([
            'hero_title_id' => 'Tumbuh bersama, dengan cara yang lebih adil.',
            'hero_title_en' => 'Grow together, in a fairer way.',
            'whatsapp' => '6281234567890',
            'meta_description' => 'Koperasi yang menghubungkan anggota, modal, dan kesempatan secara terbuka.',
        ] as $key => $value) {
            SiteContent::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
