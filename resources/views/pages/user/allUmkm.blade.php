@extends('layouts.app')


@section('content')
    <style>
        body {
            background-color: rgb(22, 22, 22);

        }

        .item {
            width: 400px;
            padding: 0px;
            overflow: hidden;
        }

        .cards {
            width: 18rem;
        }
    </style>

    <div class="text-center h-100vh">
        <div class="d-flex">

            <div class="col rightContent bg-white  ">

                <div class="h-100vh">
                    <div class="allBody h-screen">
                        <h1 class="fw-bold my-5">All UMKM</h1>
                        <div class="mt-5">
                            <form id="searchForm" class="px-5">
                                <div class="input-group mb-3">
                                    <input type="text" name="search" class="form-control" placeholder="Cari UMKM..."
                                        value="{{ $search ?? '' }}" id="searchInput">
                                    <button class="btn mainColor text-white" type="submit">Cari</button>
                                </div>
                            </form>
                        </div>
                        <div class="row g-4">
                            @foreach ($umkm as $umkms)
                                <div class="col allItem">
                                    <div class="m-auto align-items-center cards">
                                        <a class="text-decoration-none" href="{{ route('detailAll', ['id' => $umkms->detailUmkm->id]) }}">

                                            <div class="card" style="width: 18rem; height:344px">
                                                <img class="card-img-top" style="height: 200px"
                                                    src="{{ Storage::url('files/documentUser/profileUMKM/' . $umkms->detailUmkm->original_photoname) }}"
                                                    width="1366px" height="200px" alt="image">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title text-decoration-none txtMain">
                                                        {{ $umkms->umkm }}</h5>
                                                    <p class="card-text mb-2 txtMain" style="height:48px">
                                                        {{ $umkms->detailUmkm->description }}
                                                    </p>
                                                    <a href="{{ route('detail', ['id' => $umkms->detailUmkm->id]) }}"
                                                        class="btn mainColor text-light fw-bold">Go
                                                        somewhere</a>

                                                </div>
                                            </div>
                                        </a>
                                    </div>

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

                $('.allItem').each(function() {
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


    @vite('resources/js/app.js')

    @vite('resources/js/home.js')
@endsection
