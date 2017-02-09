<?php

namespace App\Http\Controllers;

use App\Models\Data\Faq;
use Illuminate\Support\Facades\Input;

class FaqController extends Controller
{
    public function index()
    {
        return response()->view('faq', [
            'faqs' => Faq::where('faq_status', 1)->get(),
            'id' => Input::get('id')
        ]);
    }
}
