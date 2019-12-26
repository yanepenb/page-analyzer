<?php

namespace App\Http\Controllers;

class HomePageController extends Controller
{
    public function home()
    {
        return view('home');
    }
}
