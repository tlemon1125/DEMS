<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentController extends Controller
{
    //Dashboard view
    public function dashboard() {
        return Inertia::render('Student/Dashboard');
    }
}
