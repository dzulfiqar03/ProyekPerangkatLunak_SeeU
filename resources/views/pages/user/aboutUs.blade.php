@extends('layouts.app')


@section('content')
    <div class="text-center h-screen bg-white">


        <div class="row justify-content-center m-auto">
            <div class="col-md-10 mt-5">
                <div class=" p-3 mb-5 bg-body rounded">
                    <div class="">
                        <img src="{{ Vite::asset('resources/images/jawa_timur.png') }}" alt="image" width="500"
                            class="m-auto">

                        <div class="col mt-5">
                            <h1>SEEU - SI UMKM JAWA TIMUR</h1>
                            <p class="">
                                SeeU - Sistem Informasi UMKM adalah platform yang didedikasikan untuk mendukung dan
                                mempromosikan Usaha Mikro, Kecil, dan Menengah (UMKM) di Jawa Timur. Kami
                                berkomitmen untuk memberikan solusi teknologi yang memudahkan UMKM dalam mengelola
                                operasional sehari-hari, meningkatkan visibilitas pasar, dan mengakses sumber daya
                                yang lebih luas.
                            </p>

                            <div class="row mt-5">


                                <div class="col">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h1 class="text-center">Visi</h1>

                                            <p class="card-text">
                                                Visi kami adalah menjadi penyedia layanan UMKM terdepan bagi UMKM yang ada
                                                di
                                                seluruh jawa timur agar saling terintegrasi
                                            </p>
                                        </div>
                                    </div>


                                </div>

                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <h1 class="text-center">Misi</h1>
                                            <p class="card-text">
                                                Misi kami adalah mengempower UMKM untuk tumbuh dan bersaing di era digital
                                                dengan
                                                menyediakan alat yang efektif dan efisien
                                            </p>
                                        </div>
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


    @vite('resources/js/app.js')

    @vite('resources/js/home.js')
@endsection
