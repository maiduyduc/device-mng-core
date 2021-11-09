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

        .badge-soft-accept, .badge-soft-liquidated {
            color: #f46a6a;
            background-color: rgba(244, 106, 106, .18);
        }

        .badge-soft-pending {
            color: #556ee6;
            background-color: rgba(85, 110, 230, .18);
        }

        .badge-soft-cancel {
            color: #343a40;
            background-color: rgba(52, 58, 64, .18);
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

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <p></p>
                                    <div class="page-title-right">
                                        @if(Auth::user()->menuroles == 'ktv' || Auth::user()->menuroles == 'sadmin')
                                            <a href="{{ route("auto-inventory.create") }}" class="btn btn-primary">Thêm mới</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Mã văn bản</th>
                                <th scope="col">Ghi chú</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col" style="width: 170px">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($inventories as $inventory)
                                <tr>
                                    <td>{{ $inventory->id }}</td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">{{ $inventory->full_number }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over" style="max-width: 1rem">
                                            {{ $inventory->note }}
                                        </p>
                                    </td>

                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">
                                            {{ $inventory->created_at  }}
                                        </p>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <a class="btn btn-info badge badge-info font-size-14"
                                               href="{{ route('auto-inventory.detail', ['id'=>$inventory->id]) }}">Xem chi
                                                tiết</a>
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
