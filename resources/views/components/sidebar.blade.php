    <!-- Main Sidebar Container -->
    <aside class="main-sidebar mainColor h-full">

        <div class="all-sidebar mainColor h-screen px-1 mt-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link ">
                <img class="mx-auto mb-2" src="{{ Vite::asset('resources/images/Logo/logo_verti.png') }}" width="200px"
                    alt="image">

            </a>

            <div id="accordion-collapse" class="px-3 pb-5" data-accordion="collapse">

                <h2 id="accordion-collapse-heading-1">
                    <button type="button" style="background-color: #3b4469"
                        class="flex items-center w-full justify-between p-2 font-medium rtl:text-right text-gray-500  rounded-pill focus:ring-4 click: focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                        data-accordion-target="#accordion-collapse-body-1" aria-expanded="false"
                        aria-controls="accordion-collapse-body-1">

                        <div class="row">
                            <div class="col">
                                @if (Auth::check())
                                    <!-- Profile dropdown -->
                                    <div class="relative ml-3">
                                        <div>
                                            <img class="rounded-full bg-cover border border-white"
                                                style="height:45px; width:100px"
                                                src="{{ Storage::url('images/' . Auth::user()->original_filename) }}"
                                                alt="">
                                        </div>
                                    </div>
                                @else
                                    <img class="mx-auto mb-5" src="{{ Vite::asset('/resources/images/profile.png') }}"
                                        width="40px" height="40px" alt="image">
                                @endif
                            </div>

                            <div class="col">
                                @if (Auth::check())
                                    <h5 class="fw-bold text-center text-white">{{ Auth::user()->fullName }}</h5>
                                @endif
                            </div>
                        </div>


                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <!-- Accordion Content -->
                <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
                    <div
                        class="p-4 bg-gray-800 text-center text-white rounded-lg dark:border-gray-700 dark:bg-gray-900">
                        @if (Auth::check())
                            <h5 class="mb-2">{{ Auth::user()->email }}</h5>
                            <hr class="border-gray-600 my-2">
                            <h6 class="mb-0">{{ Auth::user()->role }}</h6>
                        @else
                            <h5 class="mb-0">Please log in to access your profile information</h5>
                        @endif
                    </div>
                </div>

            </div>
            <hr>
            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">



                        <div class="w-100 mt-5 h-100 p=5">
                            <div class="d-grid">
                                @if ($currentRouteName == 'home')
                                    <a class="btn btn-warning fw-bold mb-3"
                                        href="{{ route('home') }}">Home</a>

                                    <a class="btn btn-dark mb-3" style="color:rgb(70, 70, 70)"
                                        href="{{ route('allUmkm') }}">UMKM</a>
                                    <a class="btn btn-dark mb-3" style="color:rgb(70, 70, 70)"
                                        href="{{ route('about') }}">About
                                        Us</a>
                                @elseif($currentRouteName == 'allUmkm')
                                    <a class="btn btn-dark  mb-3" style="color:rgb(70, 70, 70)"
                                        href="{{ route('home') }}">Home</a>

                                    <a class="btn btn-warning fw-bold   mb-3" href="{{ route('allUmkm') }}">UMKM</a>
                                    <a class="btn btn-dark mb-3" style="color:rgb(70, 70, 70)"
                                        href="{{ route('about') }}">About
                                        Us</a>
                                @elseif($currentRouteName == 'about')
                                    <a class="btn btn-dark  mb-3" style="color:rgb(70, 70, 70)"
                                        href="{{ route('home') }}">Home</a>

                                    <a class="btn btn-dark  mb-3" style="color:rgb(70, 70, 70)"
                                        href="{{ route('allUmkm') }}">UMKM</a>
                                    <a class="btn btn-warning fw-bold  mb-3" href="{{ route('about') }}">About
                                        Us</a>
                                @endif

                                @if ($currentRouteName == 'owner')
                                    <a class="btn btn-dark  mb-3" style="color:rgb(70, 70, 70)"
                                        href="{{ route('home') }}">Home</a>

                                    <a class="btn btn-dark  mb-3" style="color:rgb(70, 70, 70)"
                                        href="{{ route('allUmkm') }}">UMKM</a>
                                    <a class="btn btn-dark mb-3 " style="color:rgb(70, 70, 70)"
                                        href="{{ route('about') }}">About
                                        Us</a>
                                @endif


                                @if ($currentRouteName == 'dataUmkm')
                                    <a class="btn btn-dark mb-3" href="{{ route('admin.index') }}"
                                        style="color:rgb(70, 70, 70)">Home</a>

                                    <a class="btn btn-warning fw-bold  mb-3" href="{{ route('dataUmkm') }}">UMKM</a>

                                    <a class="btn btn-dark fw-bold  mb-3" href="{{ route('dataUser') }}"
                                        style="color:rgb(70, 70, 70)">Users</a>
                                @endif

                                @if (Request::is('admin'))
                                    <a class="btn btn-warning  fw-bold mb-3" href="{{ route('admin.index') }}">Dashboard</a>

                                    <a class="btn btn-dark  mb-3" href="{{ route('dataUmkm') }}"
                                        style="color:rgb(70, 70, 70)">Data Umkm</a>
                                    <a class="btn btn-dark  mb-3" href="{{ route('dataUser') }}"
                                        style="color:rgb(70, 70, 70)">Data Users</a>
                                @endif

                                @if ($currentRouteName == 'dataUser')
                                    <a class="btn btn-dark mb-3" href="{{ route('admin.index') }}"
                                        style="color:rgb(70, 70, 70)">Home</a>

                                    <a class="btn btn-dark mb-3" href="{{ route('dataUmkm') }}"
                                        style="color:rgb(70, 70, 70)">UMKM</a>
                                    <a class="btn btn-warning fw-bold  mb-3" href="{{ route('dataUser') }}">Users</a>
                                @endif
                            </div>


                        </div>




                    </ul>
                </nav>
                <!-- /.sidebar-menu -->



            </div>
            <!-- /.sidebar -->


        </div>

    </aside>

    <style>

    </style>
