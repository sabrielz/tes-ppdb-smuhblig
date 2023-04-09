<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
			[
				'key' => 'nama_lengkap',
				'value' => $this->identitas->nama_lengkap,
				'order' => null
			],
			[
				'key' => 'tanggal_lahir',
				'value' => $this->identitas->tanggal_lahir,
				'order' => null
			],
			[
				'key' => 'kode_jurusan',
				'value' => $this->identitas->jurusan->kode,
				'order' => null
			],
			[
				'key' => 'nama_jurusan',
				'value' => $this->identitas->jurusan->nama,
				'order' => null
			],
			[
				'key' => 'asal_sekolah',
				'value' => $this->identitas->asal_sekolah,
				'order' => null
			],
			[
				'key' => 'no_wa',
				'value' => $this->identitas->no_wa,
				'order' => null
			],
			[
				'key' => 'status_tes_wawancara',
				'value' => $this->status->tes_wawancara,
				'order' => null
			],
			[
				'key' => 'admin_tes_wawancara',
				'value' => $this->status->admin_tes_wawancara,
				'order' => null
			],
			[
				'key' => 'status_tes_fisik',
				'value' => $this->status->tes_fisik,
				'order' => null
			],
			[
				'key' => 'admin_tes_fisik',
				'value' => $this->status->admin_tes_fisik,
				'order' => null
			],
		];
    }
}
