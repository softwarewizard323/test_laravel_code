<?php

namespace App\Http\Controllers;

class FeaturesController extends Controller
{
    public function index()
    {
        return response()->view('features');
    }
}
