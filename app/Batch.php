<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = [
        'name',
    ];



    public function departments()
    {
        return $this->belongsToMany('App\Department');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
