@extends('apps.layouts.app')

@section('title')
    <title>Danh sách thiết bị</title>
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
    <style>
        .badge-soft-error {
            color: #f46a6a;
            background-color: rgba(244, 106, 106, .18);
        }

        .badge-soft-active {
            color: #556ee6;
            background-color: rgba(85, 110, 230, .18);
        }

        .badge-soft-inactive {
            color: #343a40;
            background-color: rgba(52, 58, 64, .18);
        }

        .badge-soft-fixing {
            color: #f1b44c;
            background-color: rgba(241, 180, 76, .18
            )
        }

        .badge-soft-liquidate {
            color: #50a5f1;
            background-color: rgba(80, 165, 241, .18)
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Danh sách thiết bị</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Thiết bị</a></li>
                            <li class="breadcrumb-item active">Danh sách thiết bị</li>
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
                                        <a href="" class="btn btn-primary">Thêm mới</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                            <tr>
                                {{--                                <th scope="col" style="width: 20px">#</th>--}}
                                <th scope="col">Mã thiết bị</th>
                                <th scope="col">Tên thiết bị</th>
                                <th scope="col">Chủng loại</th>
                                <th scope="col">Thông tin thiết bị</th>
                                <th scope="col">Ngày nhập</th>
                                <th scope="col">Hạn bảo hành</th>
                                <th scope="col">Phòng</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($devices as $device)
                                <tr>
                                    {{--                                    <td>--}}
                                    {{--                                        <p class="text-dark font-size-14 mb-0">{{ $i }}</p>--}}
                                    {{--                                        <p style="display: none;">{{ $i++ }}</p>--}}
                                    {{--                                    </td>--}}
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">{{ $device->full_number }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">{{ $device->device_name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">{{ $device->Category->name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">{{ $device->device_info }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">{{ $device->created_at }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">{{ $device->warranty_period }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">
                                            @if($device->room_id != null)
                                                {{ $device->Room->name }}
                                            @endif
                                        </p>
                                    </td>
                                    <td style="text-align: center !important;">
                                        {{--                                        <p class="text-dark font-size-14 mb-0">{{ $device->status }}</p>--}}
                                        {{--                                        <p class="text-dark font-size-14 mb-0">--}}
                                        {{--                                            --}}{{--                                            {{ $device->status }}--}}
                                        {{--                                            <span class="font-size-14 badge badge-soft-{{ $device->status }}"--}}
                                        {{--                                                  style="max-width: 20rem">--}}
                                        {{--                                            @foreach(config('status.device') as $status => $item)--}}
                                        {{--                                                    @if($status == $device->status)--}}
                                        {{--                                                        {{ $item }}--}}
                                        {{--                                                    @endif--}}
                                        {{--                                                @endforeach--}}
                                        {{--                                            </span>--}}
                                        {{--                                        </p>--}}
                                        <div class="dropdown">
                                            <a class="dropdown-toggle font-size-14" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{--                                                <i class="bx bx-dots-vertical-rounded"></i>--}}
                                                <p class="text-dark font-size-14 mb-0">
                                                    {{--                                            {{ $device->status }}--}}
                                                    <span class="font-size-14 badge badge-soft-{{ $device->status }}"
                                                          style="max-width: 20rem">
                                            @foreach(config('status.device') as $status => $item)
                                                            @if($status == $device->status)
                                                                {{ $item }}
                                                            @endif
                                                        @endforeach
                                            </span>
                                                </p>
                                            </a>
                                            <div class="dropdown-menu">
                                                <form method="post"
                                                      action="{{ route('device.active', ['id' => $device->id]) }}">
                                                    @csrf
                                                    <button class="dropdown-item"
                                                            style="@if($device->status == 'active') display:none @endif"
                                                            href="#">Đang hoạt động
                                                    </button>
                                                </form>
                                                <form method="post"
                                                      action="{{ route('device.inactive', ['id' => $device->id]) }}">
                                                    @csrf
                                                    <button class="dropdown-item"
                                                            style="@if($device->status == 'inactive') display:none @endif"
                                                            href="#">Chưa sử dụng
                                                    </button>
                                                </form>
                                                <form method="post"
                                                      action="{{ route('device.error', ['id' => $device->id]) }}">
                                                    @csrf
                                                    <button class="dropdown-item"
                                                            style="@if($device->status == 'error') display:none @endif"
                                                            href="#">Hỏng
                                                    </button>
                                                </form>
                                                <form method="post"
                                                      action="{{ route('device.fixing', ['id' => $device->id]) }}">
                                                    @csrf
                                                    <button class="dropdown-item"
                                                            style="@if($device->status == 'fixing') display:none @endif"
                                                            href="#">Đang sửa
                                                    </button>
                                                </form>
                                                <form method="post"
                                                      action="{{ route('device.liquidate', ['id' => $device->id]) }}">
                                                    @csrf
                                                    <button class="dropdown-item"
                                                            style="@if($device->status == 'liquidate') display:none @endif"
                                                            href="#">Xin thanh lý
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary badge badge-primary font-size-14"
                                           href=""
                                        >Sửa</a>
                                        <a href=""
                                           class="btn btn-danger badge badge-danger font-size-14 action_delete"
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

    <script src="{{ asset('assets/apps/js/delete.js') }}"></script>
    {{--    <script src="{{ asset('assets\apps\assets\js\sort-number-table.js') }}"></script>--}}
    {{--    <script>--}}
    {{--        $(document).ready(function() {--}}
    {{--            $('#testTB').DataTable( {--}}
    {{--                dom: 'Bfrtip',--}}
    {{--                buttons: [--}}
    {{--                    {--}}
    {{--                        extend: 'copyHtml5',--}}
    {{--                        exportOptions: {--}}
    {{--                            columns: [ 0, 1, 2, 3, 4 ]--}}
    {{--                        }--}}
    {{--                    },--}}
    {{--                    {--}}
    {{--                        extend: 'excelHtml5',--}}
    {{--                        exportOptions: {--}}
    {{--                            columns: [ 0, 1, 2, 3, 4 ]--}}
    {{--                        }--}}
    {{--                    },--}}
    {{--                    {--}}
    {{--                        extend: 'pdfHtml5',--}}
    {{--                        exportOptions: {--}}
    {{--                            columns: [ 0, 1, 2, 3, 4 ]--}}
    {{--                        }--}}
    {{--                    },--}}
    {{--                    'colvis'--}}
    {{--                ]--}}
    {{--            } );--}}
    {{--        } );--}}
    {{--    </script>--}}
@endsection
