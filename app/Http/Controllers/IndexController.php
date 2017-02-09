<?php

namespace App\Http\Controllers;

use App\Models\Data\Source;

class IndexController extends Controller
{
    public function index()
    {
        if (\Auth::check()) {
            return redirect('/dashboard');
        }

        return response()->view('index', [
            'select' => Source::where('source_discount', 0)->get(),
            'discount' => Source::where('source_discount', 1)->get(),
        ]);
    }
}
