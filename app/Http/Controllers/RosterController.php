<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RosterController extends Controller
{
    public function index(){
        return view('pages.export.index');
    }
}
