<?php

namespace Database\Seeders;

use App\Models\SiteContent;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@dharmasiaga.co.id'],
            [
                'name' => 'Admin KSP Dharma Siaga',
                'password' => Hash::make('DharmaSiaga2026!'),
            ]
        );

        foreach ([
            'hero_title_id' => 'Tumbuh bersama, dengan cara yang lebih adil.',
            'hero_title_en' => 'Grow together, in a fairer way.',
            'whatsapp' => config('cooperative.office.whatsapp_number'),
            'meta_description' => 'Koperasi yang menghubungkan anggota, modal, dan kesempatan secara terbuka.',
        ] as $key => $value) {
            SiteContent::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
