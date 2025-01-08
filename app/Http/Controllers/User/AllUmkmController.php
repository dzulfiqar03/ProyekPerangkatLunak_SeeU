<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AllUmkm;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AllUmkmController extends Controller
{
    public function index(){
        $user = User::all();
        $umkm = AllUmkm::where('id_user', Auth::user()->id);
        $pageTitle = "UMKM";

        return view('pages.user.allUmkm', [
            'user' => $user,
            'umkm' => $umkm,
            'pageTitle' => $pageTitle,

        ]);
    }
}
