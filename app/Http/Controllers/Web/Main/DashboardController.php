<?php

namespace App\Http\Controllers\Web\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(){
        return Inertia::render('main/dashboard/Index');
    }

    public function store(){

    }
}
