<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\UMKM;

class UmkmDetailController extends Controller
{
    public function index($id)
    {
        $umkm = UMKM::all();
        $umkm2 = UMKM::all();
        $idUmkm = $id;

        if (!$umkm) {
            return abort(404);
        }

        $category = Category::all();
        $pageTitle = "Detail UMKM";
        $otherUmkm = Umkm::where('id', '!=', $id)->paginate(3);;

        return view('pages.user.umkm_detail', [
            'umkm' => $umkm,
            'idUmkm' => $idUmkm,
            'pageTitle' => $pageTitle,
            'category' => $category,
            'umkm2' => $umkm2,
            'otherUmkm' => $otherUmkm

        ]);
    }

    public function show($id)
    {
        $umkm = UMKM::findOrFail($id);
        return view('umkm.show', compact('umkm'));
    }
}
