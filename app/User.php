<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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


    public function student(){
        $roles= $this->roles;

        foreach ($roles as $role) {
            $array= $role;
            $name= $role->name;
        }

        if (empty($array)) {
            return false;
        }

        if ($name=='student') {
            return true;
        }
        return false;
    }

    public function lecturer(){
        $roles= $this->roles;

        foreach ($roles as $role) {
            $array= $role;
            $name= $role->name;
        }

        if (empty($array)) {
            return false;
        }

        if ($name=='lecturer' || $name=='admin') {
            return true;
        }
        return false;
    }

    public function admin(){
        $roles= $this->roles;

        foreach ($roles as $role) {
            $array= $role;
            $name= $role->name;
        }

        if (empty($array)) {
            return false;
        }

        if ($name=='admin' ) {
            return true;
        }
        return false;
    }






    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function departments()
    {
        return $this->belongsToMany('App\Department');
    }

    public function batches()
    {
        return $this->belongsToMany('App\Batch');
    }

    public function applications()
    {
        return $this->belongsToMany('App\Application');
    }

    public function rolls()
    {
        return $this->hasOne('App\Roll');
    }


}
