@extends('apps.layouts.app')

@section('title')
    <title>Danh sách vai trò</title>
@endsection
@section('link')
    <link href="{{ asset('assets\apps\assets\apps\assets\libs\datatables.net-bs4\css\dataTables.bootstrap4.min.css') }}"
          rel="stylesheet"
          type="text/css">
    <link href="{{ asset('assets\apps\assets\apps\assets\libs\datatables.net-buttons-bs4\css\buttons.bootstrap4.min.css') }}"
          rel="stylesheet"
          type="text/css">
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets\apps\assets\apps\assets\libs\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css') }}"
          rel="stylesheet" type="text/css">
    <style>
        th, td {
            vertical-align: middle !important;
            text-align: center !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Danh sách vai trò</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Vai trò</a></li>
                            <li class="breadcrumb-item active">Danh sách vai trò</li>
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
                                        <a href="{{ route('roles.create') }}" class="btn btn-primary">Tạo vai trò
                                            mới</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <colgroup>
                                <col span="1">
                                <col span="1">
                                <col span="1">
                                <col span="1">
                                <col span="1">
                                <col span="1">
                                <col span="1">
                                <col span="1" style="min-width: 3rem">
                            </colgroup>

                            <thead>
                            <tr>
                                <th scope="col">Tên vai trò</th>
                                <th scope="col">Tên hiển thị</th>
                                <th scope="col">Cấp bậc</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Ngày chỉnh sửa</th>
                                <th scope="col">Tăng cấp bậc</th>
                                <th scope="col">Hạ cấp bậc</th>
                                <th scope="col">Hành động</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">{{ $role->name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">{{ $role->display_name }}</p>
                                    </td>
                                    <td><p class="text-dark font-size-14 mb-0">{{ $role->hierarchy }}</p></td>
                                    <td><p class="text-dark font-size-14 mb-0">{{ $role->created_at }}</p></td>
                                    <td><p class="text-dark font-size-14 mb-0">{{ $role->updated_at }}</p></td>
                                    <td>
                                        <a class="btn btn-success"
                                           href="{{ route('roles.up', ['id' => $role->id]) }}">
                                            <i class="mdi mdi-arrow-up-bold-outline"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-success"
                                           href="{{ route('roles.down', ['id' => $role->id]) }}">
                                            <i class="mdi mdi-arrow-down-bold-outline"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <a href="{{ route('roles.edit', $role->id ) }}"
                                               class="btn btn-primary badge badge-primary font-size-14">
                                                Sửa
                                            </a>
                                            <form action="{{ route('roles.destroy', $role->id ) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger badge badge-danger font-size-14">Xóa
                                                </button>
                                            </form>
                                        </div>
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
    <script src="{{ asset('assets\apps\assets\apps\assets\libs\datatables.net\js\jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\apps\assets\libs\datatables.net-bs4\js\dataTables.bootstrap4.min.js') }}"></script>

    <!-- Responsive examples -->
    <script
        src="{{ asset('assets\apps\assets\apps\assets\libs\datatables.net-responsive\js\dataTables.responsive.min.js') }}"></script>
    <script
        src="{{ asset('assets\apps\assets\apps\assets\libs\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets\apps\assets\apps\assets\js\pages\datatables.init.js') }}"></script>
@endsection
