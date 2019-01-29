<?php

namespace App\Http\Controllers;

use App\Groep;
use App\Trainer;
use App\Training;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //Geeft de Admin index view terug met alle trainingen
    public function getIndex()
    {
        if(Gate::denies('admin-only', Auth::user())) {
            return redirect()->back();
        }else {
            $trainings = Training::orderBy('datum', 'asc')->get();

            return view('admin.index', ['trainings' => $trainings]);
        }
    }
    //Geeft de create training view terug
    public function getCreate()
    {
        if(Gate::denies('admin-only', Auth::user())) {
            return redirect()->back();
        }else {
            $groeps = Groep::all();
            $trainers = Trainer::all();
            return view('admin.create', [
                'groeps' => $groeps,
                'trainers' => $trainers]);
        }
    }
    //Geeft de edit training view terug
    public function getEdit($id)
    {
        if(Gate::denies('admin-only', Auth::user())) {
            return redirect()->back();
        }else {
            $training = Training::find($id);
            $groeps = Groep::all();
            $trainers = Trainer::all();
            return view('admin.edit', [
                'training' => $training,
                'tId' => $id,
                'groeps' => $groeps,
                'trainers' => $trainers]);
        }
    }
    //Delete de training en returned terug naar de index
    public function getDelete($id)
    {
        if(Gate::denies('admin-only', Auth::user())) {
            return redirect()->back();
        }else {
            $training = Training::find($id);
            $training->groeps()->detach();

            $training->delete();

            return redirect()->action('AdminController@getIndex');
        }
    }

}
