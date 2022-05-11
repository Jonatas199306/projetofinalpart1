<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepassesController extends Controller
{
    public function index()
    {
        return view('pages.repasses.index');
    }
}
