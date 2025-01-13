@php
    $currentRouteName = Route::currentRouteName();
@endphp

@extends('layouts.app')

@section('content')
    @foreach ($umkm as $umkm)
        @if ($idUmkm == $umkm->id)
            <div class="container-fluid px-5 container-custom mb-5">
                <div class="pt-5">
                    <div class="row no-gutters">
                        <!-- Left Column for Image -->
                        <div class="col">
                            <div class="mb-4">
                                <img src="{{ Storage::url('files/documentUser/profileUMKM/' . $umkm->original_photoname) }}"
                                    class="img-fluid rounded-3 shadow-lg" width="100%" alt="UMKM Image">
                            </div>
                            

                            <div class="gallery">
                                <div class="image-container">
                                    @foreach ($umkm->photoUmkm as $photo)
                                        <div class="image-item">
                                            <img src="{{ Storage::url('files/documentUser/galleryUmkm/' . $photo->original_photoname) }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <style>
                                .gallery {
                                    overflow-x: auto; /* Enable horizontal scrolling */
                                }
                            
                                .image-container {
                                    display: flex; /* Display images in a row */
                                }
                            
                                .image-item {
                                    margin-right: 10px; /* Add spacing between images */
                                }


                            .image-item img {
                                width: 100%;
                                height: 100px;

                            }
                            </style>

                        </div>

                        <!-- Right Column for UMKM Details -->
                        <div class="col-md-6 col-lg-6">
                            <div class="p-4">
                                <h1 class="mb-4 text-primary">UMKM Detail</h1>
                                <p class="text-muted mb-4">Here you can find detailed information about the UMKM.</p>

                                <!-- UMKM Basic Information -->
                                <ul class="list-unstyled mb-4">
                                    <li class="mb-3">
                                        <strong>Nama UMKM:</strong>
                                        <p class="content-text">{{ $umkm->allUmkm->umkm }}</p>
                                    </li>
                                    <li class="mb-3">
                                        <strong>Description:</strong>
                                        <p class="content-text">{{ $umkm->description }}</p>
                                    </li>
                                </ul>

                                <!-- UMKM Contact & Category -->
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <strong>Email:</strong>
                                        <p class="content-text">{{ $umkm->email }}</p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>Address:</strong>
                                        <p class="content-text">{{ $umkm->address }}</p>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <strong>Category:</strong>
                                        <p class="content-text">{{ $umkm->allUmkm->category->name }}</p>
                                    </div>
                                </div>

                                <!-- UMKM Additional Information -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="card shadow-sm">
                                            <div class="card-body">
                                                <h5 class="card-title">Phone</h5>
                                                <p class="card-text">{{ $umkm->telephone_number }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="card shadow-sm">
                                            <div class="card-body">
                                                <h5 class="card-title">Established</h5>
                                                <p class="card-text">
                                                    {{ \Carbon\Carbon::parse($umkm->created_at)->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Back Button and Edit Button -->
                                <div class="row">


                                    @if ($currentRouteName == 'detailOwner')
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-outline-dark btn-lg w-100"
                                                data-bs-toggle="modal" data-bs-target="#editUMKM">
                                                <i class="bi bi-pencil me-2"></i>Edit UMKM
                                            </button>
                                        </div>

                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-outline-dark btn-lg w-100"
                                                data-bs-toggle="modal" data-bs-target="#addPhoto">
                                                <i class="bi bi-pencil me-2"></i>Add Photo
                                            </button>
                                        </div>
                                    @endif
                                </div>

                                <div class="mt-5">
                                    <a href="@if ($currentRouteName !== 'gstDetail' && $currentRouteName !== 'detailOwner' && $currentRouteName !== 'detailAll' && $currentRouteName !== 'detailAdmin') {{ route('home', ['id' => $umkm->allumkm->id_user]) }}  @elseif($currentRouteName == 'detailAll') {{ route('allUmkm') }} @elseif($currentRouteName == 'detailAdmin') {{ route('dataUmkm') }}  @elseif($currentRouteName === 'detailOwner') {{ route('owner', ['id' => $umkm->allumkm->id_user]) }}   @else {{ route('guest') }} @endif"
                                        class="btn btn-dark btn-lg w-100">
                                        Back
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit UMKM Modal -->
            @if ($currentRouteName !== 'gstDetail')
                <div class="d-grid gap-2 text-start">
                    <div class="modal fade" id="editUMKM" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('umkm.update', $umkm->allUmkm->id) }}" method="POST"
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
                                                name="umkm" id="umkm" value="{{ $umkm->allUmkm->umkm }}"
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

                                        <div class="col-md-12 mb-3">
                                            <label for="cities" class="form-label">Cities</label>
                                            <select name="cities" id="cities" class="form-select">
                                                @foreach ($cities as $cities)
                                                    <option value="{{ $cities->id }}"
                                                        {{ old('cities') == $cities->id ? 'selected' : '' }}>
                                                        {{ $cities->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <div class="text-danger">
                                                    <small>{{ $message }}</small>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="address" class="form-label">Address</label>
                                            <input class="form-control @error('address') is-invalid @enderror"
                                                type="text" name="address" id="address"
                                                value="{{ $umkm->address }}" placeholder="Enter Address">
                                            @error('address')
                                                <div class="text-danger">
                                                    <small>{{ $message }}</small>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="telNum" class="form-label">Telephone Number</label>
                                            <input class="form-control @error('telNum') is-invalid @enderror"
                                                type="text" name="telNum" id="telNum"
                                                value="{{ $umkm->telephone_number }}"
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


                <div class="d-grid gap-2 text-start">
                    <div class="modal fade" id="addPhoto" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('imageUmkm.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="id_umkm" value="{{ $umkm->id }}">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Foto UMKM</h5>
                                    </div>
                                    <div class="modal-body">


                                        <div class="col-md-12 mb-3">
                                            <label for="cv" class="form-label">
                                                Profil Usaha
                                            </label>
                                            <div class="input-group">
                                                <div class="icon">
                                                    <img src="{{ Vite::asset('resources/images/Icon/imgIcon.png') }}"
                                                        alt="image" width="25">

                                                </div>
                                                <input type="file" class="form-control" name="imgPhoto"
                                                    id="imgPhoto">
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
        @endif
    @endforeach

    @if ($currentRouteName !== 'gstDetail')
        @foreach ($allUmkm as $umkms)
            <div class="d-grid gap-2 text-start">
                <div class="modal fade" id="addPhoto" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('imageUmkm.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="id_umkm" value="{{ $umkms->id }}">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Foto UMKM</h5>
                                </div>
                                <div class="modal-body">


                                    <div class="col-md-12 mb-3">
                                        <label for="cv" class="form-label">
                                            Profil Usaha
                                        </label>
                                        <div class="input-group">
                                            <div class="icon">
                                                <img src="{{ Vite::asset('resources/images/Icon/imgIcon.png') }}"
                                                    alt="image" width="25">

                                            </div>
                                            <input type="file" class="form-control" name="imgPhoto" id="imgPhoto">
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
        @endforeach
    @endif

    <div class="col px-5 mb-5">
        <h1>Other UMKM</h1>

        <div class="product-list-container">
            <div class="product-list-item" id="culinary">
                <div class="row">
                    @foreach ($otherUmkm as $umkms)
                        <div class="col itemUMKM rounded-lg" id="searchResults">
                            <a href="@if ($currentRouteName === 'detailOwner') {{ route('detailOwner', ['id' => $umkms->id]) }} @elseif ($currentRouteName === 'detailAll') {{ route('detailAll', ['id' => $umkms->id]) }}  @elseif ($currentRouteName === 'detailAdmin') {{ route('detailAdmin', ['id' => $umkms->id]) }} @elseif ($currentRouteName === 'gstDetail') {{ route('gstDetail', ['id' => $umkms->id]) }} @else {{ route('detail', ['id' => $umkms->id]) }} @endif"
                                class="hover:bg-slate-200 cursor-pointer text-decoration-none text-black">
                                <div class="itemcard" style="width: 100%">
                                    <img src="{{ Storage::url('files/documentUser/profileUMKM/' . $umkms->original_photoname) }}"
                                        alt="image" style="height: 200px; width: 100%; border-radius:20px">
                                    <div class="card-body text-center mt-3">
                                        <h5>{{ $umkms->umkm }}</h5>
                                        <p>{{ $umkms->description }}</p>
                                        <a href="{{ route('detail', ['id' => $umkms->id]) }}"
                                            class="btn mainColor text-light fw-bold">Go
                                            somewhere</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>
    </div>


    <script>
        const items = document.querySelectorAll(".itemcard");
        items.forEach(row => {
            row.style.borderRadius = "20px"
            row.style.padding = "5px"
            row.addEventListener('mouseover', function() {
                row.style.backgroundColor = "#ddd"
            })
            row.addEventListener('mouseout', function() {
                row.style.backgroundColor = "white"
            })
        });

        function filterTable(category) {
            const rows = document.querySelectorAll(".product-list-item .itemUMKM");

            rows.forEach(row => {
                const rowCategory = row.getAttribute("data-kategori");
                if (category === "All Categories" || rowCategory === category) {
                    row.style.display = ""; // Tampilkan baris
                } else {
                    row.style.display = "none"; // Sembunyikan baris
                }
            });

            // Update tombol aktif

            const buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(button => {
                button.classList.remove('btn-success');
                button.classList.add('btn-light');
            });

            // Add 'active' class to the clicked button
            const clickedButton = document.querySelector(`button[onclick="filterTable('${category}')"]`);
            clickedButton.classList.add('btn-success');
            clickedButton.classList.remove('btn-light');
        }
    </script>

    <style>
        /* CSS styling for the layout */
        .container-fluid {
            margin-top: 20px;
        }



        .product-list-container {
            overflow-x: auto;
            white-space: nowrap;
        }

        .product-list-item {
            display: none;
            margin-right: 20px;
            flex-shrink: 0;
        }

        .product-list-item:first-child {
            display: block;
        }

        .card {
            width: 200px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        /* Additional styling for responsiveness */
        @media (max-width: 768px) {
            .container-fluid {
                flex-direction: column;
            }

            .category-sidebar {
                width: 100%;
                margin-bottom: 20px;
            }

            .product-list-container {
                overflow-x: auto;
            }
        }
    </style>

    @vite('resources/js/app.js')

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container-custom {
            padding: 0 15px;
        }

        .content-text {
            font-size: 1rem;
            color: #495057;
        }

        .btn-outline-dark {
            border-color: #343a40;
            color: #343a40;
            background-color: transparent;
            transition: all 0.3s ease;
        }

        .btn-outline-dark:hover {
            color: #fff;
            background-color: #343a40;
        }

        .img-fluid {
            border-radius: 12px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card {
            border-radius: 8px;
        }

        .modal-lg {
            max-width: 800px;
        }

        .modal-body {
            padding: 30px;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            font-size: 14px;
        }

        .modal-header {
            border-bottom: 1px solid #ddd;
        }

        .modal-footer .btn {
            border-radius: 8px;
        }

        .card:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        /* Add responsiveness */
        @media (max-width: 768px) {
            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
@endsection
