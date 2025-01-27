@extends('layouts.app')


@section('content')

    <style>
        body {
            background-color: rgb(22, 22, 22);

        }

        .itemBtn {
            width: max-content;
            border: 0px
        }
    </style>

    @if (Auth::check())
        <div class="text-center">
            <div class="d-flex">


                <div class="col rightContent bg-white vh-100 ">


                    <div class="umkmList bg-white">
                        <div class="container bg-white">
                            <div class="row mb-0">
                                <div class="topUmkmList mt-5">

                                    <h1 class="fw-bold">UMKM</h1>
                                    <div class="mt-5">

                                        <div class="row px-5">
                                            <div class="col text-start">
                                                <button type="button" class="btn mainColor text-light fw-bold"
                                                    data-bs-toggle="modal" data-bs-target="#createUMKM">
                                                    <i class="bi bi-plus-circle me-1"></i>Create UMKM
                                                </button>

                                            </div>

                                            <div class="col">
                                                <form id="searchForm">
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="search" class="form-control"
                                                            placeholder="Cari UMKM..." value="{{ $search ?? '' }}"
                                                            id="searchInput">
                                                        <button class="btn mainColor text-white"
                                                            type="submit">Cari</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>


                            <div class="item-body mt-5  @if ($umkm->isEmpty()) pl-10 ml-5 @endif pb-5 d-flex">
                                <div class="sub-body1">
                                    <div class="text-center item2">
                                        <div class="row product-list2 w-100">

                                            @if ($umkm->isEmpty())
                                                <p>Kosong</p>
                                            @endif
                                            @foreach ($umkm as $umkms)
                                            <div class="col items" style="padding: 0; flex: 0">
                                                <a class="text-decoration-none" href="{{ route('detailOwner', ['id' => $umkms->detailUmkm->id]) }}">
                                                    <div class="card" style="width: 18rem; height:344px">
                                                        <img class="card-img-top" style="height: 200px"
                                                            src="{{ Storage::url('files/documentUser/profileUMKM/' . $umkms->detailUmkm->original_photoname) }}"
                                                            width="1366px" height="200px" alt="image">
                                                        <div class="card-body">
                                                            <h5 class="card-title text-decoration-none txtMain">
                                                                {{ $umkms->umkm }}</h5>
                                                            <p class="card-text mb-2 txtMain" style="height:48px">
                                                                {{ $umkms->detailUmkm->description }}
                                                            </p>
                                                            <div class="d-flex justify-content-between">
                                                                <a href="" class="btn mainColor text-light fw-bold">Go somewhere</a>
                                                                <form action="{{ route('umkm.destroy', ['umkm' =>  $umkms->id]) }}" method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit" class="btn btn-outline-dark btn-sm me-2 btn-delete">
                                                                        <i class="bi-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>

                            </div>



                        </div>
                    </div>



                </div>

            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#searchInput').on('keyup', function() {
                    var searchText = $(this).val().toLowerCase();

                    $('.items').each(function() {
                        var umkmName = $(this).find('h5').text().toLowerCase();
                        var umkmDescription = $(this).find('p').text().toLowerCase();

                        if (umkmName.includes(searchText) || umkmDescription.includes(searchText)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });
            });

            $(document).ready(function() {
                $('#searchForm').submit(function(event) {
                    event.preventDefault();
                    var searchText = $('#searchInput').val().toLowerCase();

                    $('.items').each(function() {
                        var umkmName = $(this).find('h5').text().toLowerCase();
                        var umkmDescription = $(this).find('p').text().toLowerCase();

                        if (umkmName.includes(searchText) || umkmDescription.includes(searchText)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });
            });
        </script>

        <div class="d-grid gap-2 text-start">
            <div class="modal fade" id="createUMKM" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('approveumkm.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah UMKM</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="umkm" class="form-label">UMKM</label>
                                    <input class="form-control @error('umkm') is-invalid @enderror" type="text"
                                        name="umkm" id="umkm" value="{{ old('umkm') }}" placeholder="Enter UMKM">
                                    @error('umkm')
                                        <div class="text-danger">
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <input class="form-control @error('description') is-invalid @enderror" type="text"
                                        name="description" id="description" value="{{ old('description') }}"
                                        placeholder="Enter Description">
                                    @error('description')
                                        <div class="text-danger">
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="text"
                                        name="email" id="email" value="{{ old('email') }}"
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
                                    <input class="form-control @error('address') is-invalid @enderror" type="text"
                                        name="address" id="address" value="{{ old('address') }}"
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
                                        name="telNum" id="telNum" value="{{ old('telNum') }}"
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
                                        <input type="file" class="form-control" name="imgPhoto" id="imgPhoto">
                                    </div>
                                    @error('imgPhoto')
                                        <div class="text-danger"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    @endif


    <script>
        var btnTgl1 = document.getElementById('btnTgl1');
        var btnTgl2 = document.getElementById('btnTgl2');
        var leftContent = document.getElementById('leftContent');
        var backToogle = document.getElementById('backToogle');



        btnTgl1.addEventListener("click", function() {
            leftContent.style.display = "grid";
            btnTgl1.style.transform = "scale(0)";
            backToogle.style.transform = "scale(1)";
            backToogle.style.position = "static";
            btnTgl1.style.position = "absolute";
        });

        backToogle.addEventListener("click", function() {
            leftContent.style.display = "none";
            btnTgl1.style.transform = "scale(1)";
            backToogle.style.transform = "scale(0)";
        });



        const btn2 = document.querySelector(".btn2");
        const btn3 = document.querySelector(".btn3");
        const btn4 = document.querySelector(".btn4");

        const product2 = document.querySelector(".product-list2");
        const product3 = document.querySelector(".product-list3");
        const product4 = document.querySelector(".product-list4");

        btn2.addEventListener("click", function() {
            btn2.classList.toggle("active");
            btn3.classList.remove("active");
            btn4.classList.remove("active");

            product2.style.transform = "translateX(0px)";
            product3.style.transform = "translateX(0px)";
            product4.style.transform = "translateX(0px)";
        });

        btn3.addEventListener("click", function() {
            btn3.classList.toggle("active");
            btn2.classList.remove("active");
            btn4.classList.remove("active");

            product2.style.transform = "translateX(-1170px)";
            product2.style.transition = "3s";
            product3.style.transform = "translateX(-1170px)";
            product3.style.transition = "3s";
            product4.style.transform = "translateX(-1170px)";
            product4.style.transition = "3s";
        });

        btn4.addEventListener("click", function() {
            btn4.classList.toggle("active");
            btn2.classList.remove("active");
            btn3.classList.remove("active");

            product2.style.transform = "translateX(-2330px)";
            product2.style.transition = "3s";
            product3.style.transform = "translateX(-2330px)";
            product3.style.transition = "3s";
            product4.style.transform = "translateX(-2330px)";
            product4.style.transition = "3s";
        });
    </script>

    @include('sweetalert::alert')

    @vite('resources/js/app.js')

    @vite('resources/js/home.js')


@endsection
