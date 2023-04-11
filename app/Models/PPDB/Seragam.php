<?php

namespace App\Models\PPDB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seragam extends Model
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
	protected $table = 'seragams';

	protected $fillable = [
		'ukuran_wearpack',
		'ukuran_olahraga',
		'ukuran_almamater'
	];
	
	/**
	 * Eloquent relationship method
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function identitas () {
		return $this->belongsTo(Identitas::class, 'identitas_id', 'id');
	}
}
