<?php

namespace App\Http\Controllers;

use App\Charts\UmkmChart;
use App\Exports\UmkmExport;
use App\Models\ApproveUMKMModel;
use App\Models\Category;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;
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
    public function index(UmkmChart $chart)
    {
        $approveUMKM = ApproveUMKMModel::all();
        $category = Category::all();
        $user = User::all();
        $umkm = Umkm::all();
        $umkmCount = Umkm::all()->count();
        $culinary = Umkm::where('category_id', 1)->get();
        $fashion = Umkm::where('category_id', 2)->get();
        $service = Umkm::where('category_id', 3)->get();
        $pageTitle = "Admin Dashboard";

        return view('Menu.admin', [
            'user' => $user,
            'category' => $category,
            'umkm' => $umkm,
            'umkmCount' => $umkmCount,
            'culinary' => $culinary,
            'fashion' => $fashion,
            'service' => $service,
            'chart' => $chart->build(),
            'pageTitle' => $pageTitle,
            'approveUMKM' => $approveUMKM,

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


        // ELOQUENT
        $umkm = new Umkm;
        $umkm->umkm = $request->umkm;
        $umkm->description = $request->description;
        $umkm->email = $request->email;
        $umkm->address = $request->address;
        $umkm->id_user = $request->id;
        $umkm->telephone_number = $request->telNum;
        $umkm->category_id = $request->category;

        $original_filesname = $request->usahaDoc;
        $encrypted_filesname = $request->encDoc;


        $original_photoname = $request->imgPhoto;
        $encrypted_photoname = $request->encPhoto;


        $umkm->original_photoname = $original_photoname;
        $umkm->encrypted_photoname = $encrypted_photoname;

        $umkm->original_filesname = $original_filesname;
        $umkm->encrypted_filesname = $encrypted_filesname;

        $umkm->save();

        return redirect()->route('admin.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $umkm = Umkm::find($id);

        return view('umkm.show', compact('umkm'));
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
        $file = $request->file('usahaDoc');
        $photo = $request->file('imgPhoto');

        if ($file != null && $photo != null) {
            $original_filesname = $file->getClientOriginalName();
            $encrypted_filesname = $file->hashName();

            // Store File
            $file->store('public/files/documentUser/suratIzin');

            $original_photoname = $photo->getClientOriginalName();
            $encrypted_photoname = $photo->hashName();

            // Store File
            $photo->store('public/files/documentUser/profileUMKM');
        }

        // ELOQUENT
        $umkm = Umkm::find($id);
        $umkm->umkm = $request->umkm;
        $umkm->description = $request->description;
        $umkm->email = $request->email;
        $umkm->address = $request->address;
        $umkm->telephone_number = $request->telNum;
        $umkm->category_id = $request->category;

        if ($file != null && $photo != null) {
            $umkm->original_photoname = $original_photoname;
            $umkm->encrypted_photoname = $encrypted_photoname;

            $umkm->original_filesname = $original_filesname;
            $umkm->encrypted_filesname = $encrypted_filesname;
        }

        $umkm->save();



        return redirect()->route('dataUmkm');
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

        return redirect()->route('admin.index')->with('success', 'Data berhasil ditambahkan');    }

    public function exportExcel()
    {
        return Excel::download(new UmkmExport, 'umkm.xlsx');
    }

    public function exportPdf()
    {
        $umkm = Umkm::all();

        $pdf = PDF::loadView('umkm.export_pdf', compact('umkm'));

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
