<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Illuminate\Auth\Authenticatable;


class User extends Authenticatable
{
    protected $primaryKey = 'id';
	protected $fillable = [
        'username', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * 一对一：用户关联用户详情
     */
    public function userinfo(){
    	return $this->hasOne('App\Userinfo', 'user_id');
    }
    /**
     * 一对一：用户关联头像
     */
    public function headimage(){
        return $this->hasOne('App\Headimage', 'user_id');
    }
}
