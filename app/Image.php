<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'path',
    ];




    public function applications()
    {
        return $this->belongsToMany('App\Application');
    }
}
