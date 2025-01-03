<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\UMKM;

class umkmDetailController extends Controller
{
    public function index($id)
    {
        $umkm = UMKM::all();

        $idUmkm = $id;

        if (!$umkm) {
            return abort(404);
        }

        $category = Category::all();

        $pageTitle = "Detail UMKM";


        return view('umkm.umkm_detail', [
            'umkm' => $umkm,
            'idUmkm' => $idUmkm,
            'pageTitle' => $pageTitle,
            'category' => $category

        ]);
    }

    public function show($id)
    {
        $umkm = UMKM::findOrFail($id);
        return view('umkm.show', compact('umkm'));
    }
}
