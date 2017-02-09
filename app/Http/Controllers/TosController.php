<?php

namespace App\Http\Controllers;

class TosController extends Controller
{
    public function index()
    {
        return response()->view('tos');
    }
}
