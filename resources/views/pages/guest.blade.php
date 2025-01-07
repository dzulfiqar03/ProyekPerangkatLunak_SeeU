@extends('layouts.app')


@section('content')
    <style>
        .modal-backdrop.show {
            opacity: 0;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>


    </head>

    <body>

        <div class="text-center">

            <div class="w-screen vh-100">

                <nav class="navbar navbar-expand-md navbar-dark mainColor fixed-top">
                    <div class="container">
                        <a href="" class="navbar-brand mb-0 h1"> <img
                                src="{{ Vite::asset('resources/images/Logo/mainLogo-light-txt.png') }}" width="100px"
                                alt="image" class="d-block  m-auto">
                        </a>
                        <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="d-flex gap-3">
                            <a id="profileButton" class="btn btn-outline-light my-2 ms-md-auto"
                                href="{{ route('login') }}">Login</a>
                            <a id="profileButton" class="btn btn-outline-light my-2 ms-md-auto"
                                href="{{ route('register') }}">Register</a>
                        </div>

                    </div>
                </nav>
                {{-- header --}}
                <div id="carouselExampleInterval" class="carousel slide mt-5" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="2000">
                            <img src="{{ Vite::asset('resources/images/vector/1.png') }}" class="d-block w-100"
                                alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="{{ Vite::asset('resources/images/vector/2.png') }}" class="d-block w-100"
                                alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ Vite::asset('resources/images/vector/3.png') }}" class="d-block w-100"
                                alt="...">
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

                                                <table id="getCategory2">
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
                                                        <a href="{{ route('gstDetail', ['id' => $umkms->id]) }}"
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

                {{-- about 1 --}}
                <section id="aboutus" class="py-5 bg-light">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6 mb-4 mb-lg-0">
                                <h1 class="display-3 fw-bold">Semua Berawal Dari <span class="txtMain">SeeU</span></h1>
                                <p class="lead my-4">Bersama kami membangun UMKM Jawa Timur</p><a
                                    class="btn btn-lg mainColor text-light fw-bold" href="{{ route('register') }}">Daftar
                                    Sekarang</a>
                            </div>
                            <div class="col-lg-6"><img alt="" class="img-fluid"
                                    src="{{ Vite::asset('resources/images/vector/Shoppinglogin2.png') }}"></div>
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

                {{-- about 2 --}}
                <section class="py-3 py-md-5">
                    <div class="container">
                        <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center">
                            <div class="col-12 col-lg-6 col-xl-5">
                                <img class="img-fluid rounded" src="{{ Vite::asset('resources/images/Seeeu.webp') }}"
                                    alt="About 1">
                            </div>
                            <div class="col-12 col-lg-6 col-xl-7">
                                <div class="row justify-content-xl-center">
                                    <div class="col-12 col-xl-11">
                                        <h2 class="mb-3">Kenapa Harus Kami?</h2>
                                        <p class="mb-5">Website UMKM yang menyediakan layanan untuk mengembangkan UMKM
                                            Anda.</p>
                                        <div class="row gy-4 gy-md-0 gx-xxl-5X">
                                            <div class="col-12 col-md-6">
                                                <div class="d-flex">
                                                    <div class="me-4 text-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                            width="32" height="32">
                                                            <path
                                                                d="M256 48C141.1 48 48 141.1 48 256v40c0 13.3-10.7 24-24 24s-24-10.7-24-24V256C0 114.6 114.6 0 256 0S512 114.6 512 256V400.1c0 48.6-39.4 88-88.1 88L313.6 488c-8.3 14.3-23.8 24-41.6 24H240c-26.5 0-48-21.5-48-48s21.5-48 48-48h32c17.8 0 33.3 9.7 41.6 24l110.4 .1c22.1 0 40-17.9 40-40V256c0-114.9-93.1-208-208-208zM144 208h16c17.7 0 32 14.3 32 32V352c0 17.7-14.3 32-32 32H144c-35.3 0-64-28.7-64-64V272c0-35.3 28.7-64 64-64zm224 0c35.3 0 64 28.7 64 64v48c0 35.3-28.7 64-64 64H352c-17.7 0-32-14.3-32-32V240c0-17.7 14.3-32 32-32h16z" />
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <h2 class="h4 mb-3">Konsultasi 24 Jam</h2>
                                                        <p class="text-secondary mb-0">Anda mengalami masalah? kami siap
                                                            membantu</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="d-flex">
                                                    <div class="me-4 text-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                            width="32" height="32">
                                                            <path
                                                                d="M4.1 38.2C1.4 34.2 0 29.4 0 24.6C0 11 11 0 24.6 0H133.9c11.2 0 21.7 5.9 27.4 15.5l68.5 114.1c-48.2 6.1-91.3 28.6-123.4 61.9L4.1 38.2zm503.7 0L405.6 191.5c-32.1-33.3-75.2-55.8-123.4-61.9L350.7 15.5C356.5 5.9 366.9 0 378.1 0H487.4C501 0 512 11 512 24.6c0 4.8-1.4 9.6-4.1 13.6zM80 336a176 176 0 1 1 352 0A176 176 0 1 1 80 336zm184.4-94.9c-3.4-7-13.3-7-16.8 0l-22.4 45.4c-1.4 2.8-4 4.7-7 5.1L168 298.9c-7.7 1.1-10.7 10.5-5.2 16l36.3 35.4c2.2 2.2 3.2 5.2 2.7 8.3l-8.6 49.9c-1.3 7.6 6.7 13.5 13.6 9.9l44.8-23.6c2.7-1.4 6-1.4 8.7 0l44.8 23.6c6.9 3.6 14.9-2.2 13.6-9.9l-8.6-49.9c-.5-3 .5-6.1 2.7-8.3l36.3-35.4c5.6-5.4 2.5-14.8-5.2-16l-50.1-7.3c-3-.4-5.7-2.4-7-5.1l-22.4-45.4z" />
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <h2 class="h4 mb-3">Gratis Seumur Hidup</h2>
                                                        <p class="text-secondary mb-0">Unggah UMKM tidak akan dikenakan
                                                            biaya apapun</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- footer --}}
                <footer id="footer" class="text-center text-lg-start text-white p-4"
                    style="background-color: #344C64">
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
                                        <a class="text-white">Culinary</a>
                                    </p>
                                    <p>
                                        <a class="text-white">Fashion</a>
                                    </p>
                                    <p>
                                        <a class="text-white">Service</a>
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
                                        <a href="{{ route('login') }}" class="text-white">Login</a>
                                    </p>
                                    <p>
                                        <a href="{{ route('register') }}" class="text-white">Register</a>
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
        </div>

        @vite('resources/js/app.js')


    @vite('resources/js/home.js')
    @endsection


    @push('scripts')
    <script type="module">
        $(document).ready(function() {
            $("#getCategory2").DataTable({
                serverSide: false,
                processing: false,
                bPaginate: false,
                info: false,
                ajax: '{!! route('getCategory2') !!}',
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