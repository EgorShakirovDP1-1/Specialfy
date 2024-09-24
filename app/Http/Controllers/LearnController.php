<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class LearnController extends Controller
{
    public function index() {
        return Inertia::render('Learn/Learn');
    }
}
