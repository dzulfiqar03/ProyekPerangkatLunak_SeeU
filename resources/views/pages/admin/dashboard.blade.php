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
                            <div class="row justify-content-center g-4">
                                <!-- Culinary -->
                                @foreach($categories as $category)
                                <div class="col-md-4">
                                    <div class="content shadow bg-gradient text-white rounded text-center py-4">
                                        <h3 class="py-2 w-100 rounded fw-bold bg-secondary">{{ $category->name }}</h3>
                                        <h5 class="fw-bold counter display-4" data-total="{{ $category->allumkm_count }}">0</h5>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            
                            <style>
                                /* Grid styling */

                            
                                /* Content card styling */
                                .content {
                                    background: linear-gradient(135deg, #6a11cb, #2575fc); /* Gradient background */
                                    border-radius: 12px; /* Rounded corners */
                                    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* Shadow for depth */
                                    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth hover effects */
                                }
                            
                                .content:hover {
                                    transform: translateY(-10px); /* Lift card on hover */
                                    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3); /* Stronger shadow on hover */
                                }
                            
                                /* Title styling */
                                .content h3 {
                                    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
                                    color: #3984ce; /* White text */
                                    padding: 10px;
                                    border-radius: 8px;
                                    margin-bottom: 20px;
                                    font-size: 1.5rem; /* Adjust size for readability */
                                }
                            
                                /* Counter styling */
                                .counter {
                                    font-size: 2.5rem; /* Larger number */
                                    font-weight: bold;
                                    color: #3984ce; /* Light color for contrast */
                                }
                            
                                /* Responsive adjustments */
                                @media (max-width: 768px) {
                                    .content h3 {
                                        font-size: 1.25rem; /* Adjust title size for smaller screens */
                                    }
                                    .counter {
                                        font-size: 2rem; /* Adjust counter size */
                                    }
                                }
                            </style>
                            
                            <script>
                                // Fungsi untuk animasi angka bertambah
                                function animateCounter(element, duration) {
                                    const target = parseInt(element.getAttribute('data-total'), 10); // Ambil total dari atribut data
                                    let current = 0; // Awal angka
                                    const increment = target / (duration / 10); // Hitungan per interval (10ms)
                            
                                    const interval = setInterval(() => {
                                        current += increment; // Tambahkan angka secara perlahan
                                        if (current >= target) {
                                            current = target; // Jika sudah mencapai target, hentikan
                                            clearInterval(interval);
                                        }
                                        element.textContent = Math.floor(current); // Tampilkan angka
                                    }, 10); // Jalankan setiap 10ms
                                }
                            
                                // Ambil semua elemen dengan class "counter"
                                const counters = document.querySelectorAll('.counter');
                            
                                // Terapkan animasi pada setiap elemen
                                counters.forEach(counter => {
                                    animateCounter(counter, 2000); // Animasi selama 2 detik
                                });
                            </script>
                            
                        </div>

                        <div class="row">
                            <div class="col" style="width: 100px">
                                <div class="p-6 m-20 bg-white rounded shadow" style="width: 600px">
                                    {!! $chart->container() !!}
                                </div>

                                <script src="{{ $chart->cdn() }}"></script>

                                {{ $chart->script() }}
                            </div>

                            <div class="col">
                                <div class="col text-center">
                                    <!-- Menampilkan penghitung total pengguna -->
                                    <div id="counter" class="counter-display" data-total-users="{{ $user->count() }}">0</div>
                                    <h1 class="counter-title">Total Pengguna</h1>
                                </div>
                                
                                <style>
                                    /* CSS untuk tampilan penghitung */
                                    .counter-display {
                                        font-size: 64px; /* Ukuran teks besar */
                                        font-weight: bold;
                                        color: #3498db; /* Warna biru */
                                        margin-bottom: 10px; /* Jarak dengan judul */
                                        transition: color 0.3s ease; /* Efek transisi warna */
                                    }
                                
                                    .counter-display:hover {
                                        color: #2ecc71; /* Ubah warna saat dihover */
                                    }
                                
                                    .counter-title {
                                        font-size: 24px; /* Ukuran teks judul */
                                        font-weight: 500;
                                        color: #555; /* Warna teks judul */
                                        margin: 0; /* Hapus margin default */
                                    }
                                
                                  
                                </style>
                                
                                <script>
                                    // Fungsi untuk animasi angka bertambah
                                    function animateCounter(target, duration) {
                                        const counterElement = document.getElementById('counter');
                                        let current = 0; // Awal angka
                                        const increment = target / (duration / 10); // Hitungan per interval (10ms)
                                
                                        const interval = setInterval(() => {
                                            current += increment; // Tambahkan angka secara perlahan
                                            if (current >= target) {
                                                current = target; // Jika sudah mencapai target, hentikan
                                                clearInterval(interval);
                                            }
                                            counterElement.textContent = Math.floor(current); // Tampilkan angka
                                        }, 10); // Jalankan setiap 10ms
                                    }
                                
                                    // Ambil total pengguna dari atribut data
                                    const totalUsers = parseInt(document.getElementById('counter').getAttribute('data-total-users'), 10);
                                    animateCounter(totalUsers, 2000); // Animasi selama 2 detik
                                </script>
                                
                                <div class="p-6 m-20 bg-white rounded shadow" style="transform: scale(0.8)">
                                    {!! $chart2->container() !!}
                                </div>

                                <script src="{{ $chart2->cdn() }}"></script>

                                {{ $chart2->script() }}

                            </div>
                        </div>








                        <div class="col mt-5">
                            <h1 class="text-start">Approval UMKM Section</h1>
                            <table class="table table-bordered table-hover table-striped mb-0 bg-white" id="umkmTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>UMKM</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Telephone Number</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($approveUMKM as $umkm)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img class="m-auto" style="height: 200px; width:400px"
                                                    src="{{ Storage::url('files/documentUser/profileUMKM/' . $umkm->original_photoname) }}"
                                                    alt="image"></td>
                                            <td>{{ $umkm->umkm }}</td>
                                            <td>{{ $umkm->email }}</td>
                                            <td>{{ $umkm->telephone_number }}</td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-outline-dark btn-lg mt-3 fw-bold w-100 fw-bold"
                                                    data-bs-toggle="modal" data-bs-target="#showUMKM{{ $umkm->id }}">
                                                    <i class="bi bi-person-lines-fill me-1"></i>Show
                                                </button>
                                            </td>
                                        </tr>

                                        <div class="d-grid gap-2 text-start ">
                                            <div class="d-grid gap-2 text-start">
                                                <div class="modal fade" id="showUMKM{{ $umkm->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="p-3">

                                                                <form id="myForm" action="{{ route('admin.store') }}"
                                                                    method="POST" enctype="multipart/form-data">

                                                                    {{ csrf_field() }}

                                                                    <input type="hidden" name="id"
                                                                        value="{{ $umkm->id_user }}">

                                                                    <div class="w-100 justify-content-center">
                                                                        <div class="bg-light rounded-3">
                                                                            <div class="p-3">
                                                                                <div class="mb-3 text-center">
                                                                                    <i class="bi-person-circle fs-1"></i>
                                                                                    <h4>UMKM {{ $umkm->umkm }}</h4>
                                                                                </div>
                                                                                <hr>
                                                                                <div class=" mb-3 w-100">
                                                                                    <label for="umkm"
                                                                                        class="form-label">First
                                                                                        Name</label>

                                                                                    <h5 class="w-full">{{ $umkm->umkm }}
                                                                                    </h5>
                                                                                    <input
                                                                                        class="form-control
                                                                                    @error('umkm') is-invalid @enderror"
                                                                                        type="hidden" name="umkm"
                                                                                        id="umkm"
                                                                                        value="{{ $errors->any() ? old('umkm') : $umkm->umkm }}"
                                                                                        placeholder="Enter UMKM">

                                                                                </div>
                                                                                <div class=" mb-3 w-100">
                                                                                    <label for="description"
                                                                                        class="form-label">Description</label>
                                                                                    <h5 class="w-100">
                                                                                        {{ $umkm->description }}</h5>
                                                                                    <input
                                                                                        class="form-control @error('description')
                                                                                    is-invalid @enderror"
                                                                                        type="hidden" name="description"
                                                                                        id="description"
                                                                                        value="{{ $errors->any() ? old('description') : $umkm->description }}"
                                                                                        placeholder="Enter Description">

                                                                                </div>
                                                                                <div class=" mb-3 w-100">
                                                                                    <label for="email"
                                                                                        class="form-label">Email</label>

                                                                                    <h5>{{ $umkm->email }}</h5>
                                                                                    <input
                                                                                        class="form-control @error('email')
                                                                                    is-invalid @enderror"
                                                                                        type="hidden" name="email"
                                                                                        id="email"
                                                                                        value="{{ $errors->any() ? old('email') : $umkm->email }}"
                                                                                        placeholder="Enter Email">

                                                                                </div>
                                                                                <div class=" mb-3 w-100">
                                                                                    <label for="city"
                                                                                        class="form-label">city</label>
                                                                                    <h5>{{ $umkm->city->name }}</h5>
                                                                                    <select hidden name="city"
                                                                                        id="city" class="form-select">
                                                                                        @php
                                                                                            $selected = '';
                                                                                            if ($errors->any()) {
                                                                                                $selected = old('city');
                                                                                            } else {
                                                                                                $selected =
                                                                                                    $umkm->city_id;
                                                                                            }
                                                                                        @endphp
                                                                                        <option
                                                                                            value="{{ $umkm->city->id }}"
                                                                                            {{ $selected == $umkm->city->id ? 'selected' : '' }}>
                                                                                            {{ $umkm->city->id .
                                                                                                ' -
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ' .
                                                                                                $umkm->city->name }}
                                                                                        </option>
                                                                                    </select>

                                                                                </div>
                                                                                <div class=" mb-3 w-100">
                                                                                    <label for="address"
                                                                                        class="form-label">Address</label>

                                                                                    <h5>{{ $umkm->address }}</h5>
                                                                                    <input
                                                                                        class="form-control @error('address') is-invalid @enderror"
                                                                                        type="hidden" name="address"
                                                                                        id="address"
                                                                                        value="{{ $errors->any() ? old('address') : $umkm->address }}"
                                                                                        placeholder="Enter address">

                                                                                </div>
                                                                                <div class=" mb-3 w-100">
                                                                                    <label for="telNum"
                                                                                        class="form-label">Age</label>

                                                                                    <h5>{{ $umkm->telephone_number }}</h5>
                                                                                    <input
                                                                                        class="form-control @error('telNum') is-invalid @enderror"
                                                                                        type="hidden" name="telNum"
                                                                                        id="telNum"
                                                                                        value="{{ $errors->any() ? old('telNum') : $umkm->telephone_number }}"
                                                                                        placeholder="Enter Telephone Number">

                                                                                </div>
                                                                                <div class=" mb-3 w-100">
                                                                                    <label for="category"
                                                                                        class="form-label">category</label>
                                                                                    <h5>{{ $umkm->category->name }}</h5>
                                                                                    <select hidden name="category"
                                                                                        id="category"
                                                                                        class="form-select">
                                                                                        @php
                                                                                            $selected = '';
                                                                                            if ($errors->any()) {
                                                                                                $selected = old(
                                                                                                    'category',
                                                                                                );
                                                                                            } else {
                                                                                                $selected =
                                                                                                    $umkm->category_id;
                                                                                            }
                                                                                        @endphp
                                                                                        <option
                                                                                            value="{{ $umkm->category->id }}"
                                                                                            {{ $selected == $umkm->category->id ? 'selected' : '' }}>
                                                                                            {{ $umkm->category->id .
                                                                                                ' -
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ' .
                                                                                                $umkm->category->name }}
                                                                                        </option>
                                                                                    </select>

                                                                                </div>
                                                                                <div class=mb-3">
                                                                                    <label for="Files"
                                                                                        class="form-label">Surat
                                                                                        Izin Mendirikan
                                                                                        Usaha</label>
                                                                                    @if ($umkm->original_filesname)
                                                                                        <h5>{{ $umkm->original_filesname }}
                                                                                        </h5>
                                                                                        <a href="{{ route('admin.downloadFile', ['umkmId' => $umkm->id]) }}"
                                                                                            class="btn btn-primary btn-sm mt-2">
                                                                                            <i
                                                                                                class="bi bi-download me-1"></i>
                                                                                            Download Surat Izin
                                                                                            Mendirikan Usaha
                                                                                        </a>
                                                                                    @else
                                                                                        <h5>Tidak ada</h5>
                                                                                    @endif
                                                                                </div>
                                                                                <div class=" mb-3">


                                                                                    <input type="hidden" name="usahaDoc"
                                                                                        value="{{ $umkm->original_filesname }}">

                                                                                    <input type="hidden" name="encDoc"
                                                                                        value="{{ $umkm->encrypted_filesname }}">
                                                                                </div>

                                                                                <div class=" mb-3">
                                                                                    <label for="Files"
                                                                                        class="form-label">Profil
                                                                                        Usaha</label>
                                                                                    @if ($umkm->original_photoname)
                                                                                        <h5>{{ $umkm->original_photoname }}
                                                                                        </h5>
                                                                                        <a href="{{ route('admin.downloadFile', ['umkmId' => $umkm->id]) }}"
                                                                                            class="btn btn-primary btn-sm mt-2">
                                                                                            <i
                                                                                                class="bi bi-download me-1"></i>
                                                                                            Download Foto Profil Usaha
                                                                                        </a>
                                                                                    @else
                                                                                        <h5>Tidak ada</h5>
                                                                                    @endif
                                                                                </div>
                                                                                <div class=" mb-3">

                                                                                    <input type="hidden"
                                                                                        class="form-control"
                                                                                        name="imgPhoto" id="imgPhoto"
                                                                                        value="{{ $umkm->original_photoname }}">

                                                                                    <input type="hidden" name="encPhoto"
                                                                                        value="{{ $umkm->encrypted_photoname }}">
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="row">


                                                                                <div class="col">
                                                                                    <div class="w-full">
                                                                                        <button type="button"
                                                                                            class="btn btn-warning w-100 confirm-action btn-lg mt-3"
                                                                                            id="confirm-action"><i
                                                                                                class="bi-check-circle me-2"></i>
                                                                                            Approve</button>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="col">

                                                                                    <button type="button"
                                                                                        class="btn btn-danger w-100 confirm-action2 btn-lg mt-3"
                                                                                        id="confirm-action2"><i
                                                                                            class="bi-trash me-2"></i>
                                                                                        Reject</button>

                                                                                </div>



                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                                <script>
                                                                    var umkmId = $('#myForm input[name="id"]').val();

                                                                    $(function() {
                                                                        $(".modal").on("click", ".confirm-action", function(e) {
                                                                            Swal.fire({
                                                                                    title: 'Apakah Anda yakin?',
                                                                                    text: 'Aksi ini akan menambahkan data baru.',
                                                                                    icon: 'warning',
                                                                                    buttons: true,
                                                                                    dangerMode: true,
                                                                                })
                                                                                .then((willAdd) => {
                                                                                    if (willAdd) {
                                                                                        // Ambil data dari form
                                                                                        var formData = $('#myForm').serialize();

                                                                                        // Lakukan aksi insert
                                                                                        $.ajax({
                                                                                            type: 'POST',
                                                                                            url: '{{ route('admin.store') }}',
                                                                                            data: formData,
                                                                                            success: function(response) {
                                                                                                swal('Berhasil!', 'Data berhasil ditambahkan.',
                                                                                                        'success')
                                                                                                    .then(() => {
                                                                                                        // Setelah insert berhasil, konfirmasi hapus
                                                                                                        swal({
                                                                                                                title: 'Apakah Anda yakin ingin menghapus data lama?',
                                                                                                                text: 'Aksi ini tidak dapat dibatalkan.',
                                                                                                                icon: 'warning',
                                                                                                                buttons: true,
                                                                                                                dangerMode: true,
                                                                                                            })
                                                                                                            .then((willDelete) => {
                                                                                                                if (willDelete) {
                                                                                                                    // Ambil ID UMKM dari form

                                                                                                                    // Lakukan aksi delete
                                                                                                                    $.ajax({
                                                                                                                        type: 'DELETE',
                                                                                                                        url: '{{ route('delete') }}',
                                                                                                                        data: formData,
                                                                                                                        complete: function(
                                                                                                                            response
                                                                                                                        ) {
                                                                                                                            swal('Berhasil!',
                                                                                                                                'Data berhasil dihapus.',
                                                                                                                                'success'
                                                                                                                            );
                                                                                                                        },

                                                                                                                    });
                                                                                                                }
                                                                                                            });
                                                                                                    });
                                                                                            },
                                                                                            error: function(error) {
                                                                                                swal('Gagal!',
                                                                                                    'Terjadi kesalahan saat menambahkan data.',
                                                                                                    'error');
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                });
                                                                        });
                                                                    });

                                                                    $(function() {
                                                                        $(".modal").on("click", ".confirm-action2", function(e) {
                                                                            Swal.fire({
                                                                                    title: 'Apakah Anda yakin ingin menghapus data lama?',
                                                                                    text: 'Aksi ini tidak dapat dibatalkan.',
                                                                                    icon: 'warning',
                                                                                    buttons: true,
                                                                                    dangerMode: true,
                                                                                })
                                                                                .then((willDelete) => {
                                                                                    if (willDelete) {
                                                                                        // Ambil ID UMKM dari form
                                                                                        var formData = $('#myForm').serialize();
                                                                                        // Lakukan aksi delete
                                                                                        $.ajax({
                                                                                            type: 'DELETE',
                                                                                            url: '{{ route('delete') }}',
                                                                                            data: formData,
                                                                                            complete: function(
                                                                                                response
                                                                                            ) {
                                                                                                swal('Berhasil!',
                                                                                                    'Data berhasil dihapus.',
                                                                                                    'success'
                                                                                                );
                                                                                            },

                                                                                        });
                                                                                    }
                                                                                });
                                                                        });
                                                                    });
                                                                </script>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>


                </div>
            </div>
        </div>


    </div>




    @stack('scripts')


    @vite('resources/js/app.js')
@endsection
