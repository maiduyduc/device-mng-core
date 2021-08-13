@extends('layouts.app')

@section('title')
    <title>Permission List</title>
@endsection
@section('link')
    <link href="{{ asset('assets\libs\datatables.net-bs4\css\dataTables.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css">
    <link href="{{ asset('assets\libs\datatables.net-buttons-bs4\css\buttons.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css">
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets\libs\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css') }}"
          rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Permission List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Permissions</a></li>
                            <li class="breadcrumb-item active">Permission List</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <p></p>
                                    <div class="page-title-right">
                                        <a href="{{ route('permission.create') }}" class="btn btn-primary">Add</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th scope="col" style="width: 50px">ID</th>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Key Code</th>
                                <th scope="col" style="width: 100px">Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">{{ $permission->name }}</p>
                                    </td>
                                    <td><p class="text-dark font-size-14 mb-0">{{ $permission->display_name }}</p></td>
                                    <td><p class="text-dark font-size-14 mb-0">{{ $permission->key_code }}</p></td>
                                    <td>
                                        <a href=""
                                           class="btn btn-primary badge badge-primary font-size-14">Sửa</a>
                                        <a href=""
                                           class="btn btn-danger badge badge-danger font-size-14 action_delete"
                                           data-url=""
                                        >Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>

@endsection

@section('js')
    <!-- Required datatable js -->
    <script src="{{ asset('assets\libs\datatables.net\js\jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets\libs\datatables.net-bs4\js\dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets\libs\datatables.net-buttons\js\dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets\libs\datatables.net-buttons-bs4\js\buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets\libs\jszip\jszip.min.js') }}"></script>
    <script src="{{ asset('assets\libs\pdfmake\build\pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets\libs\pdfmake\build\vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets\libs\datatables.net-buttons\js\buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets\libs\datatables.net-buttons\js\buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets\libs\datatables.net-buttons\js\buttons.colVis.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('assets\libs\datatables.net-responsive\js\dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets\libs\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets\js\pages\datatables.init.js') }}"></script>

    <script src="{{ asset('js/delete.js') }}"></script>
@endsection