<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('configs')->insert([
            [
                'name' => 'General',
                'key' => 'general',
                'value' => json_encode([
                    'company' => [
                        'name' => 'SMK Muhammadiyah Bligo',
                        'address' => null,
                        'type' => 'School',
                        'owner' => null,
                        'logo' => 'assets/img/logo-smk.png'
                    ]
                ])
            ],
            [
                'name' => 'Dashboard Sidebar Brand',
                'key' => 'dashboard_sidebar_brand',
                'value' => json_encode([
                    'logo' => []
                ])
            ],
            [
                'name' => 'Dashboard Sidebar Menu',
                'key' => 'dashboard_sidebar_menu',
                'value' => json_encode([
                    [
                        'title' => 'Main Menu',
                        'items' => [
                            [
                                'title' => 'Home',
                                'icon' => 'home',
                            ],
                            [
                                'title' => 'Settings',
                                'icon' => 'settings',
                                'dropdowns' => [
                                    [
                                        'title' => 'General',
                                    ],
                                    [
                                        'title' => 'Preferences',
                                    ],
                                ]
                            ],
                        ]
                    ]
                ])
            ],
            [
                'name' => 'Appearance',
                'key' => 'appearance',
                'value' => json_encode([
                    'theme' => 'light',
                ])
            ],
            [
                'name' => 'Metadata Collection',
                'key' => 'metadata',
                'value' => json_encode([
                    '/' => [
                        'title' => 'Beranda'
                    ],
                    'login' => ['title' => 'Login'],
                    'dashboard' => ['title' => 'Beranda'],
                    'dashboard/question' => ['title' => 'Kelola Soal'],
                    'dashboard/question/*/edit' => ['title' => 'Edit Soal'],
                    'dashboard/loby' => ['title' => 'Pilih Siswa'],
                    'dashboard/test' => ['title' => 'Ruang Tes'],
                    'dashboard/statistic' => ['title' => 'Kelola Data'],
                ])
            ]
        ]);
    }
}
