<?php

namespace App\Http\Controllers;

use App\Models\AllUmkm;
use App\Models\Category;
use App\Models\DetailUmkm;
use App\Models\Umkm;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->get('search');

        if ($search) {
            $umkm = DetailUmkm::where('umkm', 'LIKE', "%{$search}%")
                ->orWhereHas('category', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                })
                ->get();
        } else {
            $umkm = DetailUmkm::all();
        }

        $category = Category::all();
        $user = User::all();
        $users = Auth::user();
        $umkmCount = DetailUmkm::all()->count();
        $pageTitle = "Home";
        $allUmkm = DetailUmkm::all();

        $bulanlist = ['January', 'February', 'March', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        foreach ($umkm as $item) {
            // Mengambil data tanggal dari database dan mengubahnya menjadi objek Carbon
            $tanggal = Carbon::parse($item->created_at);

            // Memformat tanggal menjadi nama bulan
            $bulan = $tanggal->format('F');

            // Menambahkan atribut baru 'bulan' pada objek data
            $item->bulan = $bulan;
        }

        return view('pages.guest', [
            'user' => $user,
            'category' => $category,
            'umkm' => $umkm,
            'umkmCount' => $umkmCount,
            'pageTitle' => $pageTitle,
            'allUmkm' => $allUmkm,
            'bulanList' => $bulanlist,
            'search' => $search,
        ]);
    }

    public function getCategory2(Request $request)
    {
        $category = Category::all();

        if ($request->ajax()) {
            return datatables()->of($category)
                ->addIndexColumn()
                ->addColumn('categories', function ($category) {
                    return view('components.categories', compact('category'));
                })
                ->toJson();
        }
    }
}
