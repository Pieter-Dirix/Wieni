<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = ['datum', 'beschrijving', 'beginEindUur', 'trainer_id'];
    //database relaties
    public function trainer() {
        return $this->belongsTo('App\Trainer');
    }

    public function groeps() {
        return $this->belongsToMany('App\Groep', 'training_groep', 'training_id', 'groep_id')->withTimestamps();
    }
}
