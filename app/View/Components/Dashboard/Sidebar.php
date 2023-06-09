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
                    'label' => 'Semua Siswa',
                    'href' => '/dashboard/student',
                    'icon' => 'fa fa-users',
                ],
                [
                    'label' => 'Tes Wawancara',
                    'href' => '/dashboard/tes/wawancara',
                    'icon' => 'fa',
                    'icontext' => 'W',
                    'dropdowns' => [
                        [
                            'label' => 'Ruang Tes',
                            'href' => '/dashboard/loby?test=wawancara',
                            'icon' => 'fa fa-sign-in-alt'
                        ],
                        [
                            'label' => 'Kelola Soal',
                            'href' => '/dashboard/question?test=wawancara',
                            'icon' => 'fa fa-list-ol',
                        ],
                        [
                            'label' => 'Kelola Data',
                            'href' => '/dashboard/statistic?test=wawancara',
                            'icon' => 'fa fa-database',
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
                            'href' => '/dashboard/loby?test=fisik',
                            'icon' => 'fa fa-sign-in-alt'
                        ],
                        [
                            'label' => 'Kelola Soal',
                            'href' => '/dashboard/question?test=fisik',
                            'icon' => 'fa fa-list-ol',
                        ],
                        [
                            'label' => 'Kelola Data',
                            'href' => '/dashboard/statistic?test=fisik',
                            'icon' => 'fa fa-database',
                        ]
                    ]
                ],

                [
                    'label' => 'Seragam',
                    'href' => '/dashboard/uniform',
                    'icon' => 'fa fa-tshirt',
                    'dropdowns' => [
                        [
                            'label' => 'Edit Seragam',
                            'href' => '/dashboard/uniform/edit',
                            'icon' => 'fa fa-edit'
                        ],
                        [
                            'label' => 'Kelola Data',
                            'href' => '/dashboard/uniform',
                            'icon' => 'fa fa-database',
                        ]
                    ]
                ],

                [
                    'label' => 'Laporan',
                    'href' => '/dashboard/laporan',
                    'icon' => 'fa fa-file',
                    'dropdowns' => [
                        [
                            'label' => 'Tes Fisik',
                            'href' => '/dashboard/laporan?test=fisik',
                            'icon' => 'fa fa-file-pdf',
												],
                        [
                            'label' => 'Tes Wawancara',
                            'href' => '/dashboard/laporan?test=wawancara',
                            'icon' => 'fa fa-file-word',
												],
                        [
                            'label' => 'Seragam',
                            'href' => '/dashboard/laporan?test=seragam',
                            'icon' => 'fa fa-tshirt',
												],
                    ]
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
