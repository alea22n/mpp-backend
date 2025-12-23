<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard utama.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // PENTING: Memuat view dari resources/views/admin/dashboard.blade.php
        return view('admin.dashboard'); 
    }
}