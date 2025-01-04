<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\User;

class AllUmkmController extends Controller
{
    public function index(){
        $user = User::all();
        $umkm = Umkm::all();
        $umkmCount = Umkm::all()->count();
        $pageTitle = "UMKM";

        return view('pages.user.allUmkm', [
            'user' => $user,
            'umkm' => $umkm,
            'umkmCount' => $umkmCount,
            'pageTitle' => $pageTitle,

        ]);
    }
}
