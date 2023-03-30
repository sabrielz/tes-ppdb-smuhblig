<?php

namespace App\View\Components\Dashboard;

use App\Models\Config;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.sidebar', [
            'brand' => [
                'logo' => 'assets/img/logo-smk-kotak.png',
                'name' => 'SMUHBLIG'
            ],
            'menu' => [
                [
                    'label' => 'Home',
                    'href' => '/dashboard',
                    'icon' => 'fa fa-home',
                ],
                [
                    'label' => 'Tes Wawancara',
                    'href' => '/dashboard/tes/wawancara',
                    'icon' => 'fa',
                    'icontext' => 'W',
                    'dropdowns' => [
                        [
                            'label' => 'Ruang Tes',
                            'href' => '/dashboard/room?test=wawancara',
                            'icon' => 'fa fa-sign-in-alt'
                        ],
                        [
                            'label' => 'Kelola Soal',
                            'href' => '/dashboard/questions?test=wawancara',
                            'icon' => 'fa fa-list-ol',
                        ],
                    ]
                ],
                [
                    'label' => 'Tes Fisik',
                    'href' => '/dashboard/test/fisik',
                    'icon' => 'fa',
                    'icontext' => 'F',
                    'dropdowns' => [
                        [
                            'label' => 'Ruang Tes',
                            'href' => '/dashboard/room?test=fisik',
                            'icon' => 'fa fa-sign-in-alt'
                        ],
                        [
                            'label' => 'Kelola Soal',
                            'href' => '/dashboard/questions?test=fisik',
                            'icon' => 'fa fa-list-ol',
                        ],
                    ]
                ],
                [
                    'label' => 'Kelola Data',
                    'href' => '/dashboard/statistic*',
                    'icon' => 'fa fa-database',
                    'dropdowns' => [
                        [
                            'label' => 'Fisik',
                            'href' => '/dashboard/statistic?test=fisik',
                            'icon' => 'fa',
                            'icontext' => 'F',
                        ],
                        [
                            'label' => 'Wawancara',
                            'href' => '/dashboard/statistic?test=wawancara',
                            'icon' => 'fa',
                            'icontext' => 'W',
                        ],
                    ]
                ],

                [
                    'label' => 'Pengaturan',
                    'href' => '/dashboard/settings',
                    'icon' => 'fa fa-cog',
                ],
                [
                    'label' => 'Log Out',
                    'href' => '/logout',
                    'icon' => 'fa fa-power-off',
                ],
            ]
        ]);
    }
}
