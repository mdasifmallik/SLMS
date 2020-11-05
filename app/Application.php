<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'subject', 'from', 'to', 'description', 'status', 'delete_status',
    ];




    public function users()
    {
        return $this->belongsToMany('App\User');
    }


    public function images()
    {
        return $this->belongsToMany('App\Image');
    }
}
