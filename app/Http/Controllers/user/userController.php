<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function index(){
        // Mengambil semua user dengan relasi point
        $users = User::with('point')->get();
        return view('dashboard', compact('users'));
    }



}
