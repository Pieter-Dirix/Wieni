<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groep extends Model
{
    //
    protected $fillable = ['naam, beschrijving'];
    //database relaties
    public function trainings() {
        return $this->belongsToMany('App\Training', 'training_groep', 'groep_id', 'training_id')->withTimestamps();
    }
}
