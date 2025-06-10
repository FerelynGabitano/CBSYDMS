<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LearnMoreController extends Controller
{
    public function index()
    {
        return view('learnmore');
    }
}