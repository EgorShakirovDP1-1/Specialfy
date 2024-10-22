<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Inertia\Inertia;
use App\Http\Requests\TermStoreRequest;

class TermController extends Controller
{
    public function index() {
        $terms = Term::all();
        return Inertia::render('Terms/Terms', compact('terms'));
    }

    public function store(TermStoreRequest $request) {
        Term::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('home')->with('message', 'Term created successfully!');
    }

    public function update(TermStoreRequest $request ,$term_id) {
        Term::find($term_id)->update($request->validated());

        return redirect()->route('home')->with('message', 'Term updated successfully!');
    }

    public function destroy(Term $term) {
        Term::find($term->id)->delete();

        return redirect()->route('home')->with('message', 'Term deleted successfully!');
    }
}
