<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StartController extends Controller
{
    //geeft de about view terug
    public function getAbout()
    {
        return view('other.about');
    }
    //geeft de login view terug
    public function getLogin()
    {
        return view('auth.login');
    }
    //geeft de index pagina terug
    public function getIndex() {
        return view('content.index');
    }

}
