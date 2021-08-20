@extends('apps.layouts.app')

@section('title')
    <title>Kiểm kê trên sổ</title>
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
        th, td{
            text-align: center!important;
            vertical-align: middle!important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Kiểm kê trên sổ</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kiểm kê</a></li>
                            <li class="breadcrumb-item active">Kiểm kê trên sổ</li>
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
                                        @if(Auth::user()->menuroles == 'ktv')
                                            <a href="{{ route("inventory.create") }}" class="btn btn-primary">Thêm mới</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="testTB" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                            <tr>
                                <th scope="col">Mã văn bản</th>
                                <th scope="col">Số lượng thiết bị</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col" style="max-width: 100px">Hành động</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($inventories as $inventory)
                                <tr>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">{{ $inventory->full_number }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">{{ $inventory->qty }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">{{ $inventory->created_at }}</p>
                                    </td>
                                    <td>
                                        <a href="{{ route('inventory.detail', ['id' => $inventory->id]) }}"
                                           class="btn btn-primary badge badge-primary font-size-14">Xem chi tiết</a>
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
    <script>
        $(document).ready(function() {
            $('#testTB').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                    },
                    'colvis'
                ],
                "order": [[ 2, "desc" ]],
            } );
        } );
    </script>
@endsection

