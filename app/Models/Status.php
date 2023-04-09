<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory, SoftDeletes;

	/**
	 * Schema Field Casting
	 */
	protected $cast = [
		'status' => 'boolean'
	];

	/**
	 * Model Attribute Properties
	 */
	protected $guarded = ['id'];

	protected $table = 'statuses';

	public function __construct(array $attributes = [])
		{
				$this->table = env('DB_DATABASE').'.'.$this->table;
				parent::__construct();
		}


	/**
	 * Eloquent Relationship Methods
	 */
	public function student () {
		return $this->belongsTo(User::class, 'student_id', 'id');
	}
	public function admin_tes_wawancara() {
		return $this->belongsTo(User::class, 'admin_tes_wawancara_id', 'id');
	}
	public function admin_tes_fisik() {
		return $this->belongsTo(User::class, 'admin_tes_fisik_id', 'id');
	}

}
