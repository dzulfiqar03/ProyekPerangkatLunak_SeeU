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
