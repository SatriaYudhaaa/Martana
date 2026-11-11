<?php

namespace App\Http\Controllers;

class FieldController extends Controller
{
    public function prime()
    {
        return view('fields.prime');
    }

    public function arena()
    {
        return view('fields.arena');
    }
}