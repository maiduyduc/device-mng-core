@extends('apps.layouts.app')

@section('title')
    <title>Danh sách nhóm thiết bị</title>
@endsection
@section('link')
    <link href="{{ asset('assets\apps\assets\libs\datatables.net-bs4\css\dataTables.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css">
    <link href="{{ asset('assets\apps\assets\libs\datatables.net-buttons-bs4\css\buttons.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css">
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets\apps\assets\libs\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css') }}"
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
                    <h4 class="mb-0 font-size-18">Danh sách nhóm thiết bị</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Thiết bị</a></li>
                            <li class="breadcrumb-item active">Danh sách nhóm thiết bị</li>
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
                                        <a href="{{ route('device-group.create') }}" class="btn btn-primary">Tạo mới</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th scope="col" style="width: 50px">ID</th>
                                <th>Tên bộ</th>
                                <th>Số lượng thiết bị</th>
                                <th>Phòng</th>
                                <th scope="col" style="width: 100px">Hành động</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($groups as $group)
                                <tr>
                                    <td>{{ $group->id }}</td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">{{ $group->name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">{{ $group->qty }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">{{ $group->Room->name }}</p>
                                    </td>
                                    <td>
                                        <a class="btn btn-info badge badge-info font-size-14"
                                           href="{{ route('device-group.detail', ['id' => $group->id]) }}"
                                        >Xem chi tiết</a>
                                        <a class="btn btn-primary badge badge-primary font-size-14"
                                           href="{{ route('device-group.edit', ['id' => $group->id]) }}"
                                        >Sửa</a>
                                        <a href=""
                                           class="btn btn-danger badge badge-danger font-size-14 action_delete"
                                           data-url="{{ route('device-group.delete', ['id'=>$group->id]) }}"
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
    <script src="{{ asset('assets\apps\assets\libs\datatables.net\js\jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\libs\datatables.net-bs4\js\dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets\apps\assets\libs\datatables.net-buttons\js\dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\libs\datatables.net-buttons-bs4\js\buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\libs\jszip\jszip.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\libs\pdfmake\build\pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\libs\pdfmake\build\vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\libs\datatables.net-buttons\js\buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\libs\datatables.net-buttons\js\buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\libs\datatables.net-buttons\js\buttons.colVis.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('assets\apps\assets\libs\datatables.net-responsive\js\dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\libs\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets\apps\assets\js\pages\datatables.init.js') }}"></script>

    <script src="{{ asset('assets/apps/js/delete.js') }}"></script>
@endsection
