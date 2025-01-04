<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    public function index()
    {

        $pageTitle = "About Us";

        return view('pages.user.aboutUs', compact('pageTitle'));
    }
}
