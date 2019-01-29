<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{

    protected $fillable = ['naam', 'ervaring'];
    //database relaties
    public function trainings() {
        return $this->hasMany('App\Training');
    }
}
