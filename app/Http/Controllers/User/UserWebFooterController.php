<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WebsiteFooter;
use Illuminate\Http\Request;

class UserWebFooterController extends Controller
{
    public function index()
    {
        $footer = WebsiteFooter::latest()->first();
        return view('frontend.partials.footer', compact('footer'));
    }
}
