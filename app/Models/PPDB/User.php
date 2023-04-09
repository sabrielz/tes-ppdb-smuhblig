<?php

namespace App\Models\PPDB;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Answer;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/*
|--------------------------------------------------------------------------
| Database TES PPDB SMK
|--------------------------------------------------------------------------
*/

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;

	protected $connection = 'mysql1';
	protected $with = ['level', 'identitas'];
	protected $table = 'users';

	public function __construct(array $attributes = [])
		{
				$this->table = env('DB_DATABASE1').'.'.$this->table;
				parent::__construct();
		}

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'username',
		'password',
		'avatar',
		'identitas_id',
		'level_id',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function level()
	{
		return $this->belongsTo(UserLevel::class, 'level_id', 'id');
	}

	public function identitas()
	{
		return $this->belongsTo(Identitas::class, 'identitas_id', 'id');
	}

	// public function jurusan()
	// {
	// 	// return JurusanStudent::where('kode', $this->username)->get();
	// }

	public function answers()
	{
		return $this->hasMany(Answer::class, 'student_id');
	}

	public function status () {
		return $this->hasOne(Status::class, 'student_id');
	}

	public function scopeFilter($query, array $filters)
	{
		$query->when($filters['search'] ?? false, function($query, $search) {
			return $query->where('username', 'like', '%'. $search .'%')
									 ->orWhere('name', 'like', '%'. $search . '%');
		});

		$query->when($filters['sort'] ?? false, function($query, $sort) {
			switch ($sort) {
				case 'nama_siswa':
					if (request('order') == 'normal') {
						return $query->orderBy('name', 'asc');
					} else if(request('order') == 'reverse') {
						return $query->orderBy('name', 'desc');
					}
					break;
				case 'kode_jurusan':
					if (request('order') == 'normal') {
						return $query->orderBy('username', 'asc');
					} else if(request('order') == 'reverse') {
						return $query->orderBy('username', 'desc');
					}
					break;
				case 'id':
					if (request('order') == 'normal') {
						return $query->orderBy('id', 'asc');
					} else if(request('order') == 'reverse') {
						return $query->orderBy('id', 'desc');
					}
					break;
				case 'status':
					if (request('order') == 'normal') {
						return $query->whereHas('status', function($query) {
							$query->where('tes_'.request('test'), true);
						});
					} else if(request('order') == 'reverse') {
						return $query->doesntHave('status')->orWhereHas('status', function($query) {
							$query->where('tes_'.request('test'), false);
						});
					}
					break;
				case 'terbaru':
					if (request('order') == 'normal') {
						return $query->whereHas('status', function($query) {
							$query->orderBy('updated_at', 'asc');
						})->orDoesntHave('status');
					} else if(request('order') == 'reverse') {
						return $query->orderBy('id', 'desc');
					}
					break;
			}
		});
	}

}
