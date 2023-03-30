<?php

namespace App\Models\PPDB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLevel extends Model
{
    use HasFactory;

		public $timestamps = false;
		protected $guarded = ['id'];
		protected $connection = 'mysql1';
}
