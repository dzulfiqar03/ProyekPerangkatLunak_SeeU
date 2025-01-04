@php
    $currentRouteName = Route::currentRouteName();
@endphp

<nav class="navbar main-header mainColor mb-0">
    <div class="container-fluid">


        <div class=" row" id="btnTgl2">
            <div class="col">
                <a class="nav-link m-auto h-max text-white" data-widget="pushmenu" href="#" role="button"><i
                        class="fas fa-bars m-auto pt-1 mt-2"></i></a>
            </div>

            <div class="col">
                <a class="navbar-brand px-3 text-white fw-bold" href="#">{{ $pageTitle }}</a>

            </div>
        </div>



        <div
            class="absolute mr-2 bottom-10 inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">


            <!-- Profile dropdown -->
            <div class="relative ml-3">
                <!-- Include Alpine.js -->
                <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.0/dist/cdn.min.js" defer></script>

                <div x-data="{ open: false }" class="relative">
                    @if (Request::is('admin'))
                        <div class="d-flex gap-6">
                            <div class="m-auto">
                                <button class="notification-button">
                                    <i class="fas fa-bell"></i>
                                    <span class="badge">{{ $approveUMKM->count() }}</span>
                                </button>
                            </div>

                            <!-- User Button -->
                            <button type="button"
                                class="relative flex px-1 rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                @click="open = !open" @keydown.escape.window="open = false" id="user-menu-button"
                                aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                @if ($currentRouteName == 'admin')
                                    <img width="50" height="100" class="rounded-full bg-cover border border-white"
                                        style="height:50px" src="" alt="User Avatar">
                                @else
                                    <img width="50" height="100" class="rounded-full bg-cover border border-white"
                                        style="height:50px"
                                        src="{{ Storage::url('images/' . Auth::user()->original_filename) }}"
                                        alt="User Avatar">
                                @endif

                                <h5 class="m-auto px-3">Profile</h5>
                                <svg data-accordion-icon class="w-3 h-3 m-auto rotate-180 shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem" data-widget="pushmenu">Your Profile</a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="btn btn-danger w-100 fw-bold btnReg border-0"
                                        type="submit">Logout</button>
                                </form>

                            </div>
                        </div>
                    @else
                        <!-- User Button -->
                        <button type="button"
                            class="relative flex px-1 rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                            @click="open = !open" @keydown.escape.window="open = false" id="user-menu-button"
                            aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            @if ($currentRouteName == 'admin')
                                <img width="50" height="100" class="rounded-full bg-cover border border-white"
                                    style="height:50px" src="" alt="User Avatar">
                            @else
                                <img width="50" height="100" class="rounded-full bg-cover border border-white"
                                    style="height:50px"
                                    src="{{ Storage::url('images/' . Auth::user()->original_filename) }}"
                                    alt="User Avatar">
                            @endif

                            <h5 class="m-auto px-3">Profile</h5>
                            <svg data-accordion-icon class="w-3 h-3 m-auto rotate-180 shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                role="menuitem" data-widget="pushmenu">Your Profile</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-danger w-100 fw-bold btnReg border-0"
                                    type="submit">Logout</button>
                            </form>

                        </div>
                    @endif

                </div>

            </div>
</nav>

<style>
    .offcanvas-backdrop.show {
        opacity: 0;
    }

    .rightContent {
        padding: 0;
    }

    .notification-button {
        position: relative;
        /* Gaya lainnya untuk tombol */
    }

    .badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 5px;
        font-size: 12px;
    }

    .fa-bell {
        font-size: 24px;
        /* Sesuaikan dengan ukuran yang diinginkan */
    }
</style>
