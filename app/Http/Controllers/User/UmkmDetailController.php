<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AllUmkm;
use App\Models\Category;
use App\Models\Cities;
use App\Models\DetailUmkm;
use App\Models\PhotoUmkm;
use App\Models\UMKM;
use Illuminate\Support\Facades\Auth;

class UmkmDetailController extends Controller
{
    public function index($id)
    {
        $umkm = DetailUmkm::all();
        $allUmkm = AllUmkm::all();
        $idUmkm = $id;

        if (!$umkm) {
            return abort(404);
        }

        $category = Category::all();
        $pageTitle = "Detail UMKM";
        $otherUmkm = DetailUmkm::where('id', '!=', $id)->paginate(3);;
        $cities = Cities::all();

        $imagePhoto = PhotoUmkm::where('id_user', Auth::user()->id)->where('umkm_id', $id)->get();

        return view('pages.user.umkm_detail', [
            'umkm' => $umkm,
            'idUmkm' => $idUmkm,
            'pageTitle' => $pageTitle,
            'category' => $category,
            'allUmkm' => $allUmkm,
            'otherUmkm' => $otherUmkm,
            'cities' => $cities,
            'imagePhoto' => $imagePhoto,

        ]);
    }

    public function show($id)
    {
        $umkm = AllUmkm::findOrFail($id);
        return view('umkm.show', compact('umkm'));
    }
}
