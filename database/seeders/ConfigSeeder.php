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
                'name' => 'Dashboard Sidebar Menu Item',
                'key' => 'dashboard_sidebar_menu_items',
                'value' => json_encode([
                    [
                        'label' => 'Home',
                        'icon' => 'fas fa-home',
                    ],
                    [
                        'label' => 'Settings',
                        'icon' => 'fas fa-cogs',
                        'dropdowns' => [
                            [
                                'label' => 'General',
                            ],
                            [
                                'label' => 'Preferences',
                            ],
                        ]
                    ],
                ])
            ],
        ]);
    }
}
