<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AllUmkm;
use App\Models\Category;
use App\Models\DetailUmkm;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UMKMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Alert::success('Added Successfully', 'UMKM Data Added Successfully.');
        $category = Category::all();
        $user = User::all();
        $umkm = AllUmkm::all();
        $umkmCount = AllUmkm::all()->count();
        $culinary = AllUmkm::orderBy('id')->take(3)->get();
        $fashion = AllUmkm::where('category_id', 2)->get();
        $service = AllUmkm::where('category_id', 3)->get();
        $pageTitle = "UMKM";


        return redirect()->route('home', ['id' => Auth::user()->id])->with([
            'user' => $user,
            'categorys' => $category,
            'umkm' => $umkm,
            'umkmCount' => $umkmCount,
            'culinary' => $culinary,
            'fashion' => $fashion,
            'service' => $service,
            'pageTitle' => $pageTitle,

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
            $photo->storeAs('public/files/documentUser/profileUMKM', $original_photoname);
        }

        // ELOQUENT
        $umkm = new Umkm();
        $umkm->umkm = $request->umkm;
        $umkm->description = $request->description;
        $umkm->email = $request->email;
        $umkm->address = $request->address;
        $umkm->id_user = $request->id;
        $umkm->telephone_number = $request->telNum;
        $umkm->category_id = $request->category;

        if ($file != null && $photo != null) {
            $umkm->original_photoname = $original_photoname;
            $umkm->encrypted_photoname = $encrypted_photoname;

            $umkm->original_filesname = $original_filesname;
            $umkm->encrypted_filesname = $encrypted_filesname;
        }

        $umkm->save();



        return redirect()->route('umkm.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $umkm = AllUmkm::with('category', 'city', 'detailUmkm')->where('id_user', Auth::user()->id);

        return view('pages.user.show', compact('umkm'));
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
    // Update UMKM Data
    public function update(Request $request, $id)
    {
        // Validasi input

        // Mulai transaksi untuk memastikan kedua update berjalan atomik
        DB::beginTransaction();

        try {
            // Temukan UMKM dan Detail UMKM berdasarkan ID
            $umkm = AllUmkm::findOrFail($id);  // Tabel allumkm
            $detailUmkm = DetailUmkm::where('umkm_id', $umkm->id)->first();  // Tabel detailUmkm

            // Update Data UMKM di Tabel AllUmkm
            $umkm->umkm = $request->umkm;
            $umkm->category_id = $request->category;
            $umkm->city_id = $request->cities;
            $umkm->save();  // Simpan perubahan pada tabel allumkm

            // Simpan Gambar UMKM jika ada yang diupload
            if ($request->hasFile('imgPhoto')) {
                // Hapus gambar lama jika ada
                if ($detailUmkm->original_photoname) {
                    Storage::delete('files/documentUser/profileUMKM/' . $detailUmkm->original_photoname);
                }
                // Upload gambar baru
                $imagePath = $request->file('imgPhoto')->storeAs('files/documentUser/profileUMKM', uniqid() . '.' . $request->imgPhoto->extension());
            } else {
                $imagePath = $detailUmkm->original_photoname;
            }

            // Simpan Surat Izin Usaha jika ada yang diupload
            if ($request->hasFile('usahaDoc')) {
                // Hapus file lama jika ada
                if ($detailUmkm->original_filesname) {
                    Storage::delete('files/documentUser/usahaDocs/' . $detailUmkm->original_filesname);
                }
                // Upload file baru
                $filePath = $request->file('usahaDoc')->storeAs('files/documentUser/usahaDocs', uniqid() . '.' . $request->usahaDoc->extension());
            } else {
                $filePath = $detailUmkm->original_filesname;
            }

            // Update Data Detail UMKM di Tabel DetailUmkm
            $detailUmkm->description = $request->description;
            $detailUmkm->email = $request->email;
            $detailUmkm->address = $request->address;
            $detailUmkm->telephone_number = $request->telNum;
            $detailUmkm->original_photoname = $imagePath;
            $detailUmkm->original_filesname = $filePath;
            $detailUmkm->save();  // Simpan perubahan pada tabel detailUmkm

            // Commit transaksi jika semuanya berhasil
            DB::commit();
            Alert::success('Added Successfully', 'UMKM Data Added Successfully.');

            // Redirect dengan pesan sukses
            return redirect()->route('umkm.detail', $umkm->id)->with('success', 'UMKM updated successfully!');
        } catch (\Exception $e) {
            // Jika ada error, rollback transaksi
            DB::rollBack();

            // Kembalikan error ke halaman sebelumnya
            return redirect()->back()->with('error', 'Failed to update UMKM: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $umkm = Umkm::find($id);

        if ($umkm) {
            if (Storage::disk('public')->exists('files/documentUser/suratIzin/' . $umkm->encrypted_filesname) && Storage::disk('public')->exists('files/documentUser/profileUMKM/' . $umkm->encrypted_photoname)) {
                Storage::disk('public')->delete('files/documentUser/suratIzin/' . $umkm->encrypted_filesname);
                Storage::disk('public')->delete('files/documentUser/profileUMKM/' . $umkm->encrypted_filesname);
                echo 'File deleted successfully.';
            } else {
                echo 'File not found.';
            }
        }
        $umkm->delete();

        return redirect()->route('dataUmkm');
    }

    public function getAllUmkm()
    {
        $category = Category::all();
        $user = User::all();
        $umkm = Umkm::all();
        $umkmCount = Umkm::all()->count();
        $pageTitle = "UMKM";

        return view('owner', [
            'user' => $user,
            'category' => $category,
            'umkm' => $umkm,
            'umkmCount' => $umkmCount,
            'pageTitle' => $pageTitle,

        ]);
    }
}
