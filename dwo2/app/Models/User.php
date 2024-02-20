<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\UserResetPassword as ResetPasswordNotification;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

     protected $table = 'DWO_PROFILE_MT';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
	protected $guarded = [];

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
        'password' => 'hashed',
    ];


	protected $primaryKey = 'profile_cust_code';
	public $incrementing = false;
	const CREATED_AT = 'profile_update';
	const UPDATED_AT = 'profile_update';

/*
 * パスワードリセット通知を管理ユーザーに送信
 *
 * @param  string  $token
 */
    public function sendPasswordResetNotification($token){

        $this->notify(new ResetPasswordNotification($token));
    }

}
