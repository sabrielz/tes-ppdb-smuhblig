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

	/**
	 * Eloquent Relationship Methods
	 */
	public function student () {
		return $this->setConnection('mysql1')->belongsTo(User::class, 'student_id', 'id');
	}
	public function admin_tes_wawancara() {
		return $this->setConnection('mysql1')->belongsTo(User::class, 'admin_tes_wawancara_id', 'id');
	}
	public function admin_tes_fisik() {
		return $this->setConnection('mysql1')->belongsTo(User::class, 'admin_tes_fisik_id', 'id');
	}

}
