<?php

namespace App\Http\Controllers;

use App\Groep;
use App\Trainer;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //geeft de overzicht view van de groepen en trainers terug
    public function getLists() {

        $groeps = Groep::all();
        $trainers = Trainer::all();
        return view('lists.groepenentrainers', ['groeps' => $groeps, 'trainers' => $trainers]);
    }
    //geeft de detail view terug van de groep met id $id
    public function getGroep($id) {

        $groep = Groep::where('id', $id)->first();
        return view('lists.groep', ['groep' => $groep]);
    }

    //geeft de detail view terug van de training met id $id
    public function getTrainer($id) {

        $trainer = Trainer::where('id', $id)->first();
        return view('lists.trainer', ['trainer' => $trainer]);
    }
}
