@extends('layouts.app')


@section('content')
    <style>
        body {

            background-color: rgb(22, 22, 22);

        }
    </style>
    <div class="text-center ">
        <div class="d-flex">

            <div class="col rightContent bg-white">
                <div class="container mt-4 bg-white">

                    <div class="categoryBody mb-5 mt-5">
                        <div class="container text-center mb-5">
                            <div class="row">
                                <div class="col">
                                    <div class="content  bg-dark text-white rounded">
                                        <h3 class=" py-2 w-100 rounded fw-bold">Culinary</h3>
                                        <h5 class="fw-bold">{{ $culinary->count() }}</h5>
                                    </div>

                                </div>
                                <div class="col">
                                    <div class="content  bg-dark text-white rounded">
                                        <h3 class="py-2 w-100 rounded fw-bold">Fashion</h3>
                                        <h5 class="fw-bold">{{ $fashion->count() }}</h5>

                                    </div>

                                </div>
                                <div class="col">
                                    <div class="content  bg-dark text-white rounded">
                                        <h3 class=" py-2 w-100 rounded  fw-bold">Service</h3>
                                        <h5 class="fw-bold">{{ $service->count() }}</h5>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="p-6 m-20 bg-white rounded shadow">
                            {!! $chart->container() !!}
                        </div>

                        <script src="{{ $chart->cdn() }}"></script>

                        {{ $chart->script() }}

                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        .rightContent.active {
            padding-left: 0px;
        }

        .rightContent.active #apexcharts9prxoflk {
            width: 500px;
        }
    </style>
    <script>
        var btnTgl1 = document.getElementById('btnTgl1');
        var btnTgl2 = document.getElementById('btnTgl2');
        var leftContent = document.getElementById('leftContent');
        var backToogle = document.getElementById('backToogle');
        var rightContent = document.querySelector('.rightContent');



        btnTgl1.addEventListener("click", function() {
            leftContent.style.display = "grid";
            btnTgl1.style.transform = "scale(0)";
            backToogle.style.transform = "scale(1)";
            backToogle.style.position = "static";
            btnTgl1.style.position = "absolute";
            rightContent.classList.add('active');
        });

        backToogle.addEventListener("click", function() {
            leftContent.style.display = "none";
            btnTgl1.style.transform = "scale(1)";
            backToogle.style.transform = "scale(0)";
        });
    </script>
    @stack('scripts')




    @vite('resources/js/app.js')
@endsection
