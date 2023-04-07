<?php

namespace App\Models\PPDB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identitas extends Model
{
	use HasFactory;

	protected $connection = 'mysql1';
	protected $table = 'identitas';
	protected $with = ['jenis_kelamin'];

	public function verifikasi()
	{
		return $this->hasOne(Verifikasi::class, 'identitas_id');
	}

	public function user()
	{
		return $this->hasOne(User::class, 'identitas_id');
	}

	public function jurusan()
	{
		return $this->hasOne(JurusanStudent::class, 'identitas_id');
	}

	public function jenis_kelamin()
	{
		return $this->belongsTo(JenisKelamin::class);
	}

}
