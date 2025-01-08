<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\User;

class DataUserController extends Controller
{
    public function index()
    {
        $user = User::all();
        $pageTitle = "Data User";

        return view('pages.admin.data_user', compact('user', 'pageTitle'));
    }
}
