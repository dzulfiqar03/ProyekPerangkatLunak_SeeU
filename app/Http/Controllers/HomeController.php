<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id)
    {
        $category = Category::all();
        $user = User::all();
        $users = Auth::user();
        $umkmCount = Umkm::all()->count();
        $culinary = UMKM::where('id_user', $id)->where('category_id', 1)->take(6)->get();
        $fashion = UMKM::where('id_user', $id)->where('category_id', 2)->take(6)->get();
        $service = UMKM::where('id_user', $id)->where('category_id', 3)->take(6)->get();
        $pageTitle = "Home";
        $umkm = Umkm::where('id_user', $users->id)->get();
        $allUmkm = Umkm::all();
        return view('home', [
            'user' => $user,
            'category' => $category,
            'umkm' => $umkm,
            'umkmCount' => $umkmCount,
            'culinary' => $culinary,
            'fashion' => $fashion,
            'service' => $service,
            'pageTitle' => $pageTitle,
            'allUmkm' => $allUmkm,
        ]);
    }


    
    public function getData(Request $request)
    {
        $umkm = Umkm::with('category');

        if ($request->ajax()) {
            return datatables()->of($umkm)
                ->addIndexColumn()
                ->addColumn('actions', function ($umkm) {
                    return view('components.actions', compact('umkm'));
                })
                ->toJson();
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
        $umkm = new Umkm;
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



        return redirect()->route('detail', $id);
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

    public function getUser(Request $request)
    {
        $user = User::all();

        if ($request->ajax()) {
            return datatables()->of($user)
                ->addIndexColumn()

                ->toJson();
        }
    }

    public function getCategory(Request $request)
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
