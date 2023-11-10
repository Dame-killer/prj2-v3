<?php

namespace App\Http\Controllers\AA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AAController extends Controller
{
    function home(){
        return view('academic_affairs.home');
    }
}
