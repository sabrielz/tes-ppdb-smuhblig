<?php

namespace App\Models\PPDB;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
			return $this->belongsTo(UserLevel::class, 'level_id','id');
		}

		public function identitas()
		{
			return $this->belongsTo(Identitas::class, 'identitas_id', 'id');
		}
}