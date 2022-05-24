<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Main home page.
     */
    public function index()
    {
        return view('home');
    }
    
    /**
     * User has submitted a PIN to join.
     * 
     * @param Request $request
     */
    public function join(Request $request)
    {
        
    }
}
