<?php

namespace App\Http\Controllers\Admin;

use App\Charts\CityChart;
use App\Http\Controllers\Controller;
use App\Charts\UmkmChart;
use App\Exports\UmkmExport;
use App\Models\AllUmkm;
use App\Models\ApproveUMKMModel;
use App\Models\Category;
use App\Models\DetailUmkm;
use App\Models\Umkm;
use App\Models\User;
use ArielMejiaDev\LarapexCharts\PieChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UmkmChart $chart, CityChart $chart2)
    {
        $approveUMKM = ApproveUMKMModel::all();
        $category = Category::all();
        $user = User::all();
        $umkm = AllUmkm::all();
        $umkmCount = AllUmkm::all()->count();
        $culinary = AllUmkm::where('category_id', 1)->get();
        $fashion = AllUmkm::where('category_id', 2)->get();
        $service = AllUmkm::where('category_id', 3)->get();
        $pageTitle = "Admin Dashboard";

        $categories = Category::withCount('allumkm')->get();

        return view('pages.admin.dashboard', [
            'user' => $user,
            'category' => $category,
            'umkm' => $umkm,
            'umkmCount' => $umkmCount,
            'culinary' => $culinary,
            'fashion' => $fashion,
            'service' => $service,
            'chart' => $chart->build(),
            'chart2' => $chart2->build(),
            'pageTitle' => $pageTitle,
            'approveUMKM' => $approveUMKM,
            'categories' => $categories,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka'
        ];

        $validator = Validator::make($request->all(), [
            'umkm' => 'required',
            'description' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'telNum' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Proses penyimpanan UMKM
            $umkm = new AllUmkm;
            $umkm->umkm = $request->umkm;
            $umkm->id_user = $request->id;
            $umkm->category_id = $request->category;
            $umkm->city_id = $request->city;
            $umkm->save();

            // Proses penyimpanan Detail UMKM
            $detailUmkm = new DetailUmkm;
            $detailUmkm->description = $request->description;
            $detailUmkm->email = $request->email;
            $detailUmkm->address = $request->address;
            $detailUmkm->telephone_number = $request->telNum;

            $original_filesname = $request->usahaDoc;
            $encrypted_filesname = $request->encDoc;
    
    
            $original_photoname = $request->imgPhoto;
            $encrypted_photoname = $request->encPhoto;
    
    
            $detailUmkm->original_photoname = $original_photoname;
            $detailUmkm->encrypted_photoname = $encrypted_photoname;
    
            $detailUmkm->original_filesname = $original_filesname;
            $detailUmkm->encrypted_filesname = $encrypted_filesname;
    
    
            // Relasi dengan UMKM yang sudah disimpan
            $detailUmkm->umkm_id = $umkm->id; // Asumsi `DetailUmkm` memiliki kolom `umkm_id`
            $detailUmkm->save();

            // Jika semua operasi berhasil, commit transaksi
            DB::commit();

            // Redirect ke halaman yang sesuai
            return redirect()->route('admin.index');
        } catch (\Exception $e) {
            // Jika ada error, rollback transaksi
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $umkm = Allumkm::with('detailUmkm')->findOrFail($id);
        return view('pages.admin.show', compact('umkm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Get File
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = $request->all();
        // Assuming you have a unique identifier in your data (e.g., 'name')
        $yourModel = ApproveUMKMModel::where('umkm', $data['umkm'])->firstOrFail();


        $yourModel->delete();

        return redirect()->route('admin.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function exportExcel()
    {
        return Excel::download(new UmkmExport, 'umkm.xlsx');
    }

    public function exportPdf()
    {
        $umkm = AllUmkm::all();

        $pdf = PDF::loadView('export.export_pdf', compact('umkm'));

        return $pdf->download('umkm.pdf');
    }

    public function downloadFile($umkmId)
    {
        $umkm = ApproveUMKMModel::find($umkmId);
        $encryptedFilename = 'public/files/documentUser/suratIzin/' . $umkm->encrypted_filesname;
        $downloadFilename = Str::lower($umkm->umkm . '_cv.pdf');

        if (Storage::exists($encryptedFilename)) {
            return Storage::download($encryptedFilename, $downloadFilename);
        }
    }
}
