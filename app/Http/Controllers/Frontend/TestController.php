<?php

namespace App\Http\Controllers\Frontend;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function index(){
        return view('tailwind');
    }
}
