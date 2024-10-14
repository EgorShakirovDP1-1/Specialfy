<?php

namespace App\Http\Controllers;

use App\Models\Film;

class LikeController extends Controller
{
    public function toggle(Film $film)
    {
        $film->likes()->toggle(auth()->id());

        return redirect()->back();
    }
}