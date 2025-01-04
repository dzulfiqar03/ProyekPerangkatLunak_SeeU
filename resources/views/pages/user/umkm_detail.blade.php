@php
    $currentRouteName = Route::currentRouteName();
@endphp

@extends('layouts.app')


@section('content')
    @foreach ($umkm as $umkm)
        @if ($idUmkm == $umkm->id)
            <div class="container-fluid container-custom h-screen">
                <div class="pt-24">
                    <div class="row no-gutters">
                        <div class="col-md-6-custom">

                            <img src="{{ Storage::url('files/documentUser/profileUMKM/' . $umkm->original_photoname) }}"
                                class="img-fluid rounded-start fixed-image" alt="UMKM Image">
                        </div>

                        <div class="col-md-6-custom-content">
                            <div class=" mt-4 p-4">
                                <h1 class="mb-4"> Detail UMKM</h1>
                                <ul class="list-unstyled mb-3 row m-auto text-center">
                                    <li class="mb-3 col">
                                        <label for="umkm" class="form-label">Nama UMKM</label>
                                        <h5 class="content-text">{{ $umkm->umkm }}</h5>
                                    </li>
                                    <li class="mb-5-custom col">
                                        <label for="description" class="form-label">Description</label>
                                        <h5 class="content-text">{{ $umkm->description }}</h5>
                                    </li>
                                </ul>
                                <div class="container text-center">
                                    <div class="row align-items-start">
                                        <div class="col-md-4 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <h5 class="content-text">{{ $umkm->email }}</h5>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <h5 class="content-text">{{ $umkm->address }}</h5>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="category" class="form-label">Category</label>
                                            <h5 class="content-text">{{ $umkm->category->name }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="w-full btn-center mt-5">
                                            <a href="@if ($currentRouteName == 'detail') {{ route('home', ['id' => $umkm->id]) }} @else {{ route('owner', ['id' => $umkm->id]) }} @endif  "
                                                class="btn btn-outline-dark btn-lg mt-3 fw-bold w-100">Back</a>
                                        </div>
                                    </div>

                                    @if ($currentRouteName == 'detailOwner')
                                        <div class="col">
                                            <div class="w-full btn-center mt-5">
                                                <button type="button"
                                                    class="btn btn-outline-dark btn-lg mt-3 fw-bold w-100 fw-bold"
                                                    data-bs-toggle="modal" data-bs-target="#editUMKM">
                                                    <i class="bi bi-plus-circle me-1"></i>Edit UMKM
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="d-grid gap-2 text-start">
                <div class="modal fade" id="editUMKM" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('umkm.update', $umkm->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit UMKM</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="umkm" class="form-label">UMKM</label>
                                        <input class="form-control @error('umkm') is-invalid @enderror" type="text"
                                            name="umkm" id="umkm" value={{ $umkm->umkm }}
                                            placeholder="Enter UMKM">
                                        @error('umkm')
                                            <div class="text-danger">
                                                <small>{{ $message }}</small>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="form-label">Description</label>
                                        <input class="form-control @error('description') is-invalid @enderror"
                                            type="text" name="description" id="description"
                                            value="{{ $umkm->description }}" placeholder="Enter Description">
                                        @error('description')
                                            <div class="text-danger">
                                                <small>{{ $message }}</small>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="text"
                                            name="email" id="email" value="{{ $umkm->email }}"
                                            placeholder="Enter Email">
                                        @error('email')
                                            <div class="text-danger">
                                                <small>{{ $message }}</small>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="form-label">Address</label>
                                        <input class="form-control @error('address') is-invalid @enderror" type="text"
                                            name="address" id="address" value="{{ $umkm->address }}"
                                            placeholder="Enter Address">
                                        @error('address')
                                            <div class="text-danger">
                                                <small>{{ $message }}</small>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="telNum" class="form-label">Telephone Number</label>
                                        <input class="form-control @error('telNum') is-invalid @enderror" type="text"
                                            name="telNum" id="telNum" value="{{ $umkm->telephone_number }}"
                                            placeholder="Enter Telephone Number">
                                        @error('telNum')
                                            <div class="text-danger">
                                                <small>{{ $message }}</small>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="category" class="form-label">Category</label>
                                        <select name="category" id="category" class="form-select">
                                            @foreach ($category as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <div class="text-danger">
                                                <small>{{ $message }}</small>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="cv" class="form-label">
                                            Surat Izin Mendirikan Usaha
                                        </label>
                                        <input type="file" class="form-control" name="usahaDoc" id="usahaDoc">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="cv" class="form-label">
                                            Profil Usaha
                                        </label>
                                        <div class="input-group">
                                            <div class="icon">
                                                <img src="{{ Vite::asset('resources/images/Icon/imgIcon.png') }}"
                                                    alt="image" width="25">

                                            </div>
                                            <input type="file" value="{{ $umkm->original_filename }}"
                                                class="form-control" name="imgPhoto" id="imgPhoto">
                                        </div>
                                        @error('imgPhoto')
                                            <div class="text-danger"><small>{{ $message }}</small></div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        @endif
    @endforeach

    @vite('resources/js/app.js')

    <style>
        body {
            background-color: #ffffff;
        }

        .card {
            border: none;
            border-radius: .25rem;
            margin-top: 18vh;
            box-shadow: 50px 50px 50px 50px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            background-color: #ffffff;
        }

        h1 {
            color: #323A5A;
            text-align: center;
        }

        label {
            font-weight: bold;
            color: #495057;
        }

        .content-text {
            font-size: 0.875rem;
            color: #343a40;
        }

        .btn-outline-dark {
            border-color: #343a40;
            color: #ffffff;
            background-color: #323A5A
        }

        .btn-outline-dark:hover {
            background-color: #343a40;
            color: #000000;
            background-color: #ffffff
        }

        .img-fluid {
            width: 100%;
            height: auto;
        }

        .container-custom {
            padding: 0 15px;
        }

        @media (min-width: 768px) {
            .col-md-6-custom {
                flex: 0 0 50%;
                max-width: 50%;
            }

            .col-md-6-custom-content {
                flex: 0 0 50%;
                max-width: 50%;
            }

            .container-custom {
                padding: 0 30px;
            }
        }

        .mb-5-custom {
            margin-bottom: 3rem;
        }

        .btn-center {
            display: flex;
            justify-content: center;
        }

        .fixed-image {
            width: 880px;
            height: 500px;
        }
    </style>
@endsection
