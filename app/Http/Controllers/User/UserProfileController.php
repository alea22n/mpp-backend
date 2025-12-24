<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WebsiteProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index(){
        $webProfile = WebsiteProfile::first();
        return view('frontend.profile.index', compact('webProfile'));
    }
}
