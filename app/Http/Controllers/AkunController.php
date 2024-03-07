<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index()
    {
        $akuns = User::all();
        return view('akun.index', compact('akuns'));
    }
}
