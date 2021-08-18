@extends('apps.layouts.app')

@section('title')
    <title>Báo cáo tổng hợp</title>
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
        .th{
            text-align: center;
            vertical-align: middle;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Lập báo cáo</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Theo dõi</a></li>
                            <li class="breadcrumb-item active">Lập báo cáo</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="col-md-4">
                        @if($type=='room')
                            <a href="{{ route('report.index','all') }}" class="btn btn-primary">Xem báo cáo toàn khoa</a>
                        @else
                            <a href="{{ route('report.index','room') }}" class="btn btn-primary">Xem báo cáo theo phòng</a>
                        @endif
                    </div>
                    <div class="page-title-right">
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if($type == 'all')
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <colgroup>
                                        <col span="1" style="width: 300px;">
                                        <col span="1">
                                    </colgroup>
                                    <thead>
                                        <th colspan="2">Báo cáo toàn khoa</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Số lượng thiết bị</td>
                                        <td>
                                            {{ $devices }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số máy đang hỏng</td>
                                        <td>
                                            {{ $deviceErrors }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Máy chưa sử dụng</td>
                                        <td>
                                            {{ $deviceInStocks }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Máy đang xin thanh lý</td>
                                        <td>
                                            {{ $deviceLiquidate }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Máy đang chờ thanh lý </td>
                                        <td>{{ $deviceInLiquidate }}</td>
                                    </tr>
                                    <tr>
                                        <td>Máy đã thanh lý</td>
                                        <td>
                                            {{ $deviceLiquidated }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                <tr>
                                    <th scope="col" class="th">Phòng</th>
                                    <th scope="col" class="th">Tổng thiết bị</th>
                                    <th scope="col" class="th">Số máy đang hỏng</th>
                                    <th scope="col" class="th">Số máy đang sửa</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($data as $dt)
                                    <tr>
                                        <td class="th">{{ $rooms[$i]->name }}</td>
                                        <td class="th">{{ $dt['devices'] }}</td>
                                        <td class="th">{{ $dt['deviceError'] }}</td>
                                        <td class="th">{{ $dt['deviceOnRepair'] }}</td>
                                    </tr>
                                    <p style="display: none"> {{ $i++ }}</p>
                                @endforeach
                                </tbody>
                            </table>

{{--                            <div class="table-responsive">--}}
{{--                                <table class="table table-bordered mb-0">--}}
{{--                                    <colgroup>--}}
{{--                                        <col span="1" style="width: 300px;">--}}
{{--                                        <col span="1">--}}
{{--                                    </colgroup>--}}
{{--                                    <thead>--}}
{{--                                    <th>Phòng</th>--}}
{{--                                    <th>Tổng thiết bị</th>--}}
{{--                                    <th>Số máy đang hỏng</th>--}}
{{--                                    <th>Số máy đang sửa</th>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($data as $dt)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{ $rooms[$i]->name }}</td>--}}
{{--                                            <td>{{ $dt['devices'] }}</td>--}}
{{--                                            <td>{{ $dt['deviceError'] }}</td>--}}
{{--                                            <td>{{ $dt['deviceOnRepair'] }}</td>--}}
{{--                                        </tr>--}}
{{--                                        <p style="display: none"> {{ $i++ }}</p>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
                        @endif
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
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('#testTB').DataTable( {--}}
{{--                dom: 'Bfrtip',--}}
{{--                buttons: [--}}
{{--                    {--}}
{{--                        extend: 'copyHtml5',--}}
{{--                        exportOptions: {--}}
{{--                            columns: [ 0, 1, 2, 3 ]--}}
{{--                        }--}}
{{--                    },--}}
{{--                    {--}}
{{--                        extend: 'excelHtml5',--}}
{{--                        exportOptions: {--}}
{{--                            columns: [ 0, 1, 2, 3 ]--}}
{{--                        }--}}
{{--                    },--}}
{{--                    {--}}
{{--                        extend: 'pdfHtml5',--}}
{{--                        exportOptions: {--}}
{{--                            columns: [ 0, 1, 2, 3 ]--}}
{{--                        }--}}
{{--                    },--}}
{{--                    'colvis'--}}
{{--                ],--}}
{{--                "order": [[ 2, "desc" ]],--}}
{{--            } );--}}
{{--        } );--}}
{{--    </script>--}}
@endsection

