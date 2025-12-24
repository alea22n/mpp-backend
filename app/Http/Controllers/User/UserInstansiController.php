<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use Illuminate\Http\Request;

class UserInstansiController extends Controller
{
    public function index()
    {
        $institutes = Instansi::with('layanan')->get();
        return view('frontend.instansi.index', compact('institutes'));
    }

    public function show($slug)
    {
        $institutes = Instansi::where('slug', $slug)->with('layanan')->firstOrFail();
        return view('frontend.instansi.show', compact('institutes'));
    }
}
