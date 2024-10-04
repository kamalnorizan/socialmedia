<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JqueryUiController extends Controller
{
    function index() {
        return view('jqueryui.index');
    }
}
