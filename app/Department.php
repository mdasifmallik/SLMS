<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name', 'lec_code', 'stu_code',
    ];



    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function batches()
    {
        return $this->belongsToMany('App\Batch');
    }

}
