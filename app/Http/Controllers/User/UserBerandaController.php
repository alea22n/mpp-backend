<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Models\Instansi;
use Illuminate\Http\Request;

class UserBerandaController extends Controller
{
    public function index()
    {
        $hero_slides = HeroSlide::all();
        $institutes = Instansi::with('layanan')->limit(8)->get();

        return view('frontend.beranda.index', compact('hero_slides', 'institutes'));
    }
}
