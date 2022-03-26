<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // １対多(Userモデルを'1'としてGoalモデルを'多')のリレーションを追加
    public function goals()
    {
        return $this->hasMany('App\Goal');
    }
    // １対多(Userモデルを'1'としてTodoモデルを'多')のリレーションを追加
    public function todos()
    {
        return $this->hasMany('App\Todo');
    }
    // １対多(Userモデルを'1'としてTagモデルを'多')のリレーションを追加
    public function tags()
    {
        return $this->hasMany('App\Tag');
    }
}
