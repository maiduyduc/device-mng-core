@extends('apps.layouts.app')

@section('title')
    <title>Kiểm kê tự động</title>
@endsection
@section('link')
    <link href="{{ asset('assets\apps\assets\libs\datatables.net-bs4\css\dataTables.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css">
    <link href="{{ asset('assets\apps\assets\libs\datatables.net-buttons-bs4\css\buttons.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css">
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets\apps\assets\libs\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css') }}"
          rel="stylesheet" type="text/css">
    <link href="{{ asset('assets\apps\assets\libs\admin-resources\rwd-table\rwd-table.min.css') }}" rel="stylesheet"
          type="text/css">
    <style>
        .text-over {
            display: inline-block;
            width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
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
                    <h4 class="mb-0 font-size-18">Kiểm kê tự động</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kiểm kê</a></li>
                            <li class="breadcrumb-item active">Kiểm kê tự động</li>
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
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                            <tr>
                                <th scope="col">Device Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Error</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr>
                                    <td colspan="4">{{ $data->Room->name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $data->device_name }}</td>

                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">{{ $data->status }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over" style="max-width: 1rem">
                                            {{ $data->qty }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over" style="max-width: 1rem">
                                            {{ $data->Error }}
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2">
                                    <button type="submit" style="width: 100%" class="btn btn-primary w-md">
                                        Lưu
                                    </button>
                                </td>
                                <td colspan="2">
                                    <a href="{{ route('auto-inventory.index') }}" style="width: 100%"
                                       class="btn btn-danger w-md">Hủy</a>
                                </td>
                            </tr>
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
    <script src="{{ asset('assets\apps\assets\libs\admin-resources\rwd-table\rwd-table.min.js') }} "></script>

    <!-- Init js -->
    <script src="{{ asset('assets\apps\assets\js\pages\table-responsive.init.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\libs\datatables.net-responsive\js\dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\libs\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets\apps\assets\js\pages\datatables.init.js') }}"></script>
    <!-- delete ajax -->
@endsection
