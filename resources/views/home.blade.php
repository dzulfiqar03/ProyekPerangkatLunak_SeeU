@extends('layouts.app')


@section('content')
    <div class="text-center">
        <div class="duration-500">

            <div class="col rightContent bg-white vh-100 ">

                <div class="heroSection bg-white">
                    <div id="carouselExampleSlidesOnly" class="carousel mt-0 mb-0 slide mx-auto" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ Vite::asset('resources/images/1.png') }}" alt="image"
                                    class="d-block w-100 m-auto">


                            </div>
                            <div class="carousel-item">
                                <img src="{{ Vite::asset('resources/images/2.png') }}" alt="image"
                                    class="d-block w-100 m-auto">


                            </div>
                            <div class="carousel-item ">
                                <img src="{{ Vite::asset('resources/images/3.png') }}" alt="image"
                                    class="d-block w-100 m-auto">


                            </div>
                        </div>

                    </div>
                </div>


                <div class="umkmList bg-white">
                    <div class="container bg-white">
                        <div class="row mb-0">
                            <div class="topUmkmList mt-5">

                                <h1 class="fw-bold">UMKM</h1>

                            </div>

                        </div>

                        <div class="container-fluid pb-5">
                            <div class="row">
                                <div class="col-3 category-sidebar ">
                                    <div class="category-list ">

                                        <div id="accordion-color" data-accordion="collapse" class=""
                                            data-active-classes="btn-success">
                                            <h2 id="accordion-color-heading-1" class="btn-success rounded-pill">
                                                <button onclick="filterTable('All Categories')"
                                                    class="flex filter-btn btn-success w-full text-base rounded-pill p-2 justify-center gap-3 items-center justify"
                                                    data-accordion-target="#accordion-color-body-1" aria-expanded="true"
                                                    aria-controls="accordion-color-body-1">
                                                    <span>All Categories</span>
                                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 10 6">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                                    </svg>
                                                </button>
                                            </h2>
                                            <div id="accordion-color-body-1" class="hidden "
                                                aria-labelledby="accordion-color-heading-1">

                                                <table id="getCategory">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>

                                        </div>



                                    </div>
                                </div>
                                <div class="col-9 product-container" style="height: 400px">
                                    <form id="searchForm">
                                        <div class="input-group mb-3">
                                            <input type="text" name="search" class="form-control"
                                                placeholder="Cari UMKM..." value="{{ $search ?? '' }}" id="searchInput">
                                            <button class="btn mainColor text-white" type="submit">Cari</button>
                                        </div>
                                    </form>

                                    <div class="product-list-container">
                                        <div class="product-list-item" id="culinary">
                                            <div class="row">
                                                @foreach ($umkm as $umkms)
                                                    <div class="col itemUMKM rounded-lg" id="searchResults"
                                                        data-kategori="{{ $umkms->category->name }}">
                                                        <a href="{{ route('detail', ['id' => $umkms->id]) }}"
                                                            class="hover:bg-slate-200 cursor-pointer text-decoration-none text-black">
                                                            <div class="itemcard" style="width: 203px">
                                                                <img src="{{ Storage::url('files/documentUser/profileUMKM/' . $umkms->original_photoname) }}"
                                                                    alt="image"
                                                                    style="height: 200px; width:300px; border-radius:20px">
                                                                <div class="card-body mt-3">
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
                            </div>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('#searchInput').on('keyup', function() {
                                    var searchText = $(this).val().toLowerCase();

                                    $('.itemUMKM').each(function() {
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
                            
                                    $('.itemUMKM').each(function() {
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



                    </div>
                </div>


                <section class="bg-light pt-10">
                    <div class="container">
                        <div class="row  align-items-center">
                            <div class="col-lg-6 mb-4 mb-lg-0">
                                <h1 class="display-3 fw-bold">Anyone, anywhere, can Create <span class="txtMain">UMKM</span>
                                </h1>
                                <p class="lead my-4 ">Buat UMKM terbaik mu untuk memperluas pasar dan jualanmu lebih
                                    laris</p><a class="btn btn-lg mainColor text-light fw-bold"
                                    href="{{ route('owner', ['id' => Auth::user()->id]) }}">Go to
                                    owner page</a>
                            </div>
                            <div class="col-lg-6">
                                <img class="img-fluid" src="{{ Vite::asset('resources/images/adImage.jpg') }}"
                                    alt="image">
                            </div>
                        </div>
                        <div class="row mt-5 justify-center text-center">
                            <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                                <div class="mb-3 m-auto">
                                    {{-- ikon mudah --}}
                                    <svg class="inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                        width="60" height="60">
                                        <path
                                            d="M313.4 32.9c26 5.2 42.9 30.5 37.7 56.5l-2.3 11.4c-5.3 26.7-15.1 52.1-28.8 75.2H464c26.5 0 48 21.5 48 48c0 18.5-10.5 34.6-25.9 42.6C497 275.4 504 288.9 504 304c0 23.4-16.8 42.9-38.9 47.1c4.4 7.3 6.9 15.8 6.9 24.9c0 21.3-13.9 39.4-33.1 45.6c.7 3.3 1.1 6.8 1.1 10.4c0 26.5-21.5 48-48 48H294.5c-19 0-37.5-5.6-53.3-16.1l-38.5-25.7C176 420.4 160 390.4 160 358.3V320 272 247.1c0-29.2 13.3-56.7 36-75l7.4-5.9c26.5-21.2 44.6-51 51.2-84.2l2.3-11.4c5.2-26 30.5-42.9 56.5-37.7zM32 192H96c17.7 0 32 14.3 32 32V448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V224c0-17.7 14.3-32 32-32z" />
                                    </svg>
                                </div>
                                <h4>Mudah</h4>
                                <p>International clients that are satisfied</p>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                                <div class="mb-3">
                                    {{-- ikon efisien --}}
                                    <svg class="inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"
                                        width="60" height="60">
                                        <path
                                            d="M184 48H328c4.4 0 8 3.6 8 8V96H176V56c0-4.4 3.6-8 8-8zm-56 8V96H64C28.7 96 0 124.7 0 160v96H192 352h8.2c32.3-39.1 81.1-64 135.8-64c5.4 0 10.7 .2 16 .7V160c0-35.3-28.7-64-64-64H384V56c0-30.9-25.1-56-56-56H184c-30.9 0-56 25.1-56 56zM320 352H224c-17.7 0-32-14.3-32-32V288H0V416c0 35.3 28.7 64 64 64H360.2C335.1 449.6 320 410.5 320 368c0-5.4 .2-10.7 .7-16l-.7 0zm320 16a144 144 0 1 0 -288 0 144 144 0 1 0 288 0zM496 288c8.8 0 16 7.2 16 16v48h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H496c-8.8 0-16-7.2-16-16V304c0-8.8 7.2-16 16-16z" />
                                    </svg>
                                </div>
                                <h4>Efisien</h4>
                                <p>Years of expertise in website design</p>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                                <div class="mb-3">
                                    {{-- ikon aman --}}
                                    <svg class="inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                        width="60" height="60">
                                        <path
                                            d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                                    </svg>
                                </div>
                                <h4>Aman</h4>
                                <p>Users believe our code snippets</p>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="mb-3">
                                    {{-- ikon trusted --}}
                                    <svg class="inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"
                                        width="60" height="60">
                                        <path
                                            d="M323.4 85.2l-96.8 78.4c-16.1 13-19.2 36.4-7 53.1c12.9 17.8 38 21.3 55.3 7.8l99.3-77.2c7-5.4 17-4.2 22.5 2.8s4.2 17-2.8 22.5l-20.9 16.2L512 316.8V128h-.7l-3.9-2.5L434.8 79c-15.3-9.8-33.2-15-51.4-15c-21.8 0-43 7.5-60 21.2zm22.8 124.4l-51.7 40.2C263 274.4 217.3 268 193.7 235.6c-22.2-30.5-16.6-73.1 12.7-96.8l83.2-67.3c-11.6-4.9-24.1-7.4-36.8-7.4C234 64 215.7 69.6 200 80l-72 48V352h28.2l91.4 83.4c19.6 17.9 49.9 16.5 67.8-3.1c5.5-6.1 9.2-13.2 11.1-20.6l17 15.6c19.5 17.9 49.9 16.6 67.8-2.9c4.5-4.9 7.8-10.6 9.9-16.5c19.4 13 45.8 10.3 62.1-7.5c17.9-19.5 16.6-49.9-2.9-67.8l-134.2-123zM16 128c-8.8 0-16 7.2-16 16V352c0 17.7 14.3 32 32 32H64c17.7 0 32-14.3 32-32V128H16zM48 320a16 16 0 1 1 0 32 16 16 0 1 1 0-32zM544 128V352c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V144c0-8.8-7.2-16-16-16H544zm32 208a16 16 0 1 1 32 0 16 16 0 1 1 -32 0z" />
                                    </svg>
                                </div>
                                <h4>Terpercaya</h4>
                                <p>Great efforts to take Designing Next Level</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Footer -->
                <footer class="text-center text-lg-start text-white p-4" style="background-color: #344C64">
                    <section class="">
                        <div class="container text-center text-md-start ">
                            <div class="row mt-3">
                                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                                    <h6 class="text-uppercase fw-bold">SEEU - Si UMKM</h6>
                                    <hr class="mb-4 mt-0 d-inline-block mx-auto"
                                        style="width: 60px; background-color: #ffffff; height: 2px" />
                                    <p>UMKM Berbasis Website yang Menampung Seluruh Data UMKM di Wilayah Jawa Timur
                                    </p>
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                                    <h6 class="text-uppercase fw-bold">Category</h6>
                                    <hr class="mb-4 mt-0 d-inline-block mx-auto"
                                        style="width: 60px; background-color: #ffffff; height: 2px" />
                                    <p>
                                        <a href="#!" class="text-white">Culinary</a>
                                    </p>
                                    <p>
                                        <a href="#!" class="text-white">Fashion</a>
                                    </p>
                                    <p>
                                        <a href="#!" class="text-white">Service</a>
                                    </p>
                                </div>
                                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                                    <h6 class="text-uppercase fw-bold">Useful links</h6>
                                    <hr class="mb-4 mt-0 d-inline-block mx-auto"
                                        style="width: 60px; background-color: #ffffff; height: 2px" />
                                    <p>
                                        <a href="#!" class="text-white">About Us</a>
                                    </p>
                                    <p>
                                        <a href="#!" class="text-white">Contact</a>
                                    </p>
                                    <p>
                                        <a href="{{ route('login') }}" class="text-white">Login</a>
                                    </p>
                                </div>
                                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                                    <h6 class="text-uppercase fw-bold">Contact</h6>
                                    <hr class="mb-4 mt-0 d-inline-block mx-auto"
                                        style="width: 60px; background-color: #ffffff; height: 2px" />
                                    <p><i class="fas fa-home mr-3"></i> Jl. Ketintang Baru No. 66</p>
                                    <p><i class="fas fa-envelope mr-3"></i> seeu@gmail.com</p>
                                    <p><i class="fas fa-phone mr-3"></i> + 62 888 888 88</p>
                                </div>
                            </div>
                        </div>
                    </section>

                </footer>
                <div class="text-center p-3 text-white" style="background-color: rgb(35, 30, 56)">
                    © 2020 Copyright :
                    <a class="text-white" href="https://www.agungjayamandiri.com/" style="text-decoration: none;">SEEU -
                        Si UMKM</a>
                </div>
            </div>

        </div>
    </div>



    <div class="d-grid gap-2 text-start">
        <div class="modal fade" id="createUMKM" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('umkm.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
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
                                <label for="category" class="form-label">category</label>
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

                            <div class="col-md-6 mb-3 w-100">

                                <div class="input-group">
                                    <div class="icon">
                                        <img src="{{ Vite::asset('resources/images/Icon/imgIcon.png') }}" alt="image"
                                            width="25">

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

    <style>
        .btn3.active,
        .btn1.active,
        .btn2.active {
            background-color: #323A5A;
            color: white
        }

        .btn3,
        .btn2,
        .btn1 {
            background-color: rgb(231, 231, 231);
            color: rgb(0, 0, 0)
        }
    </style>

<script>
    const btn1 = document.querySelector(".btn1");
    const btn2 = document.querySelector(".btn2");
    const btn3 = document.querySelector(".btn3");

    const product2 = document.querySelector(".product-list2");
    const product3 = document.querySelector(".product-list3");
    const product4 = document.querySelector(".product-list4");

    btn1.addEventListener("click", function() {
        btn1.classList.add("active");
        btn2.classList.remove("active");
        btn3.classList.remove("active");

        product2.style.transform = "translateX(0px)";
        product3.style.transform = "translateX(0px)";
        product4.style.transform = "translateX(0px)";

    });

    btn2.addEventListener("click", function() {
        btn2.classList.add("active");
        btn1.classList.remove("active");
        btn3.classList.remove("active");
        product2.style.transform = "translateX(-1393px)";
        product2.style.transition = "3s";
        product3.style.transform = "translateX(-1393px)";
        product3.style.transition = "3s";
        product4.style.transform = "translateX(-1393px)";
        product4.style.transition = "3s";
    });

    btn3.addEventListener("click", function() {
        btn3.classList.add("active");
        btn1.classList.remove("active");
        btn2.classList.remove("active");
        product2.style.transform = "translateX(-2765px)";
        product2.style.transition = "3s";
        product3.style.transform = "translateX(-2765px)";
        product3.style.transition = "3s";
        product4.style.transform = "translateX(-2765px)";
        product4.style.transition = "3s";
    });
</script>


    @include('sweetalert::alert')

    @vite('resources/js/app.js')

    @vite('resources/js/home.js')
@endsection


@push('scripts')
    <script type="module">
        $(document).ready(function() {
            $("#getCategory").DataTable({
                serverSide: false,
                processing: false,
                bPaginate: false,
                info: false,
                ajax: '{!! route('getCategory') !!}',
                columns: [

                    {
                        data: "id",
                        name: "id",
                        orderable: true,
                        searchable: true,
                        visible: false
                    },

                    {
                        data: "categories",
                        name: "categories",
                        orderable: true,
                        searchable: true
                    },

                ],
                order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"],
                ],
            });
        });
    </script>
@endpush
