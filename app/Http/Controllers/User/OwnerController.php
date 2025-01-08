<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AllUmkm;
use App\Models\DetailUmkm;
use App\Models\Category;
use App\Models\Cities;
use App\Models\Umkm;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $user = Auth::user();
        $umkmCount = DetailUmkm::all()->count();
        $pageTitle = "Owner Page";
        $umkm = AllUmkm::where('id_user', $user->id)->get();
        $cities = Cities::all();

        return view('pages.user.owner', [
            'user' => $user,
            'category' => $category,
            'umkm' => $umkm,
            'umkmCount' => $umkmCount,
            'pageTitle' => $pageTitle,
            'cities' => $cities,

        ]);
    }
}
