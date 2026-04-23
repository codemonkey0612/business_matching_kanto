<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('participant_id')) {
            return redirect()->route('matching.index');
        }
        return view('home');
    }
}
