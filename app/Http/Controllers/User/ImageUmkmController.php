<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AllUmkm;
use App\Models\DetailUmkm;
use App\Models\PhotoUmkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageUmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $umkms = DetailUmkm::all();

        foreach ($umkms as $umkms) {
            # code...
        
        return redirect()->route('detailOwner', ['id' => $umkms->id]);

    }


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

        // Get File
        $photo = $request->file('imgPhoto');

        if ($photo != null) {
            $original_photoname = $photo->getClientOriginalName();
            $encrypted_photoname = $photo->hashName();

            // Store File
            $photo->storeAs('public/files/documentUser/galleryUmkm', $original_photoname);
        }

        // ELOQUENT
        $umkm = new PhotoUmkm();
        $umkm->id_user = $request->id;
        $umkm->umkm_id = $request->id_umkm;

        if ( $photo != null) {
            $umkm->original_photoname = $original_photoname;
            $umkm->encrypted_photoname = $encrypted_photoname;

        }

        $umkm->save();



        return redirect()->route('imageUmkm.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
