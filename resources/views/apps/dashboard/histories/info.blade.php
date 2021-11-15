@extends('apps.layouts.app')

@section('title')
    <title>Lịch sử thiết bị</title>
@endsection
@section('link')
    <link href="{{ asset('assets\apps\assets\libs\datatables.net-bs4\css\dataTables.bootstrap4.min.css') }}"
          rel="stylesheet"
          type="text/css">
    <link href="{{ asset('assets\apps\assets\libs\datatables.net-buttons-bs4\css\buttons.bootstrap4.min.css') }}"
          rel="stylesheet"
          type="text/css">
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets\apps\assets\libs\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css') }}"
          rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Lịch sử thiết bị</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Thiết bị</a></li>
                            <li class="breadcrumb-item active">Lịch sử thiết bị</li>
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
                        <table id="testTB" class="table table-striped table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th scope="col" style="width: 50px">STT</th>
                                <th scope="col" style="width: 100px">Mã thiết bị</th>
                                <th scope="col" style="width: 100px">Tên thiết bị</th>
                                <th scope="col" style="width: 100px">Ngày thay đổi</th>
                                <th scope="col">Thông tin</th>
                                {{--                                <th scope="col" style="width: 100px">Hành động</th>--}}
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($histories as $history)
                                <tr>
                                    <td>
                                        {{ $i }}
                                        <p style="display: none"> {{ $i++ }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">{{ $history->Device->full_number }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">{{ $history->device_name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">{{ $history->date_modified }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">{{ $history->note }}</p>
                                    </td>
                                    {{--                                    <td>--}}
                                    {{--                                        <a href=""--}}
                                    {{--                                           class="btn btn-danger badge badge-danger font-size-14">Xem chi tiết</a>--}}
                                    {{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <a class="btn btn-outline-info font-size-14"
                       style="width: 100%"
                       href="{{ route('history.index') }}">Trở về</a>
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
    <script
        src="{{ asset('assets\apps\assets\libs\datatables.net-buttons-bs4\js\buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\libs\jszip\jszip.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\libs\pdfmake\build\pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\libs\pdfmake\build\vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\libs\datatables.net-buttons\js\buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\libs\datatables.net-buttons\js\buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\libs\datatables.net-buttons\js\buttons.colVis.min.js') }}"></script>

    <!-- Responsive examples -->
    <script
        src="{{ asset('assets\apps\assets\libs\datatables.net-responsive\js\dataTables.responsive.min.js') }}"></script>
    <script
        src="{{ asset('assets\apps\assets\libs\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js') }}"></script>

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
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    },
                    'colvis'
                ],
                "order": [[ 1, "asc" ]],
            } );
        } );
    </script>
@endsection

