<?php

namespace App\Models\PPDB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSeragam extends Model
{
    use HasFactory;

	/**
	 * Database connection name
	 * @var string
	 */
	protected $connection = 'mysql1';

	/**
	 * Database table name
	 * @var string
	 */
	protected $table = 'data_seragams';

	protected $casts = [
		'ukuran' => 'array'
	];

}
