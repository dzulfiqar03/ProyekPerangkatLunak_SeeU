<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AllUmkm;
use App\Models\Category;
use App\Models\DetailUmkm;
use App\Models\Umkm;

class DataUmkmController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $umkm = DetailUmkm::all();
        $pageTitle = "Data UMKM";

        return view('pages.admin.data_umkm', [
            'category' => $category,
            'umkm' => $umkm,
            'pageTitle' => $pageTitle,
        ]);
    }
}
