@extends('layouts.app')


@section('content')
    <div class="text-center">
        <div class="d-flex">


            <div class="col rightContent bg-white vh-100">
                <div class="container mt-4">
                    <div class="row mb-0">

                        <div class="col-lg-3 col-xl-6">
                            <ul class="list-inline mb-0 float-start">
                                <li class="list-inline-item">
                                    <a href="{{ route('admin.exportExcel') }}" class="btn btn-outline-success">
                                        <i class="bi bi-download me-1"></i> to Excel
                                    </a>
                                </li>
                                <li class="list-inline-item">|</li>
                                <li class="list-inline-item">
                                    <a href="{{ route('admin.exportPdf') }}" class="btn btn-outline-danger">
                                        <i class="bi bi-download me-1"></i> to PDF
                                    </a>
                                </li>


                            </ul>


                        </div>
                    </div>

                    <hr>
                    <div class="table-responsive border p-3 rounded-3">
                        <table class="table table-bordered table-hover table-striped mb-0 bg-white" id="userTable">
                            <thead>
                                <tr>

                                    <th></th>
                                    <th>No</th>
                                    <th>Full Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>

                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/app.js')
@endsection

@push('scripts')
    <script type="module">
        $(document).ready(function() {
            $("#userTable").DataTable({
                serverSide: true,
                processing: true,
                ajax: "/getUser",
                columns: [{
                        data: "id",
                        name: "id",
                        visible: false
                    },
                    {
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "fullName",
                        name: "fullName"
                    },
                    {
                        data: "userName",
                        name: "userName"
                    },
                    {
                        data: "email",
                        name: "email"
                    },
                    {
                        data: "role",
                        name: "role"
                    },
                ],
                order: [
                    [0, "desc"]
                ],
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"],
                ],
            });
        });
    </script>
@endpush
