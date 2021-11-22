@extends('apps.layouts.app')

@section('title')
    <title>Tìm kiếm</title>
@endsection
@section('link')
    <link href="{{ asset('assets\apps\assets\libs\select2\css\select2.min.css') }}" rel="stylesheet" type="text/css">
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
        th, td {
            vertical-align: middle !important;
            text-align: center !important;
        }

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
                    <h4 class="mb-0 font-size-18">Tìm kiếm thiết bị</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tìm kiếm - Báo cáo</a></li>
                            <li class="breadcrumb-item active">Tìm kiếm thiết bị</li>
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
                        <form action="{{ route('search.find') }}" method="get">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="control-label">Tìm kiếm theo</label>
                                        <select name="key" id="key"
                                                class="form-control select2-search-disable select2-init">
                                            <option selected value="name">
                                                Tên thiết bị
                                            </option>
                                            <option value="category">Chủng loại</option>
                                            <option value="room">Phòng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <label for="device">Thông tin tìm kiếm</label>
                                        <div class="row">
                                            <div class="col d-none" id="with_cate">
                                                <div class="position-relative">
                                                    <select name="category_id" style="width: 100%"
                                                            class="form-control select2-search-disable select2-init">
                                                        @foreach($categories as $category)
                                                            <option
                                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col d-none" id="with_room">
                                                <div class="position-relative">
                                                    <select name="room_id" style="width: 100%"
                                                            class="form-control select2-search-disable select2-init">
                                                        @foreach($rooms as $room)
                                                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col" id="device_only">
                                                <div class="position-relative">
                                                    <input type="text" name="device" placeholder="Nhập tên thiết bị"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit"
                                                        class="btn btn-primary chat-send w-md waves-effect waves-light">
                                                    <span class="d-none d-sm-inline-block mr-2">Tìm kiếm</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <p class="text-dark font-size-20">
                                Kết quả tìm kiếm cho "{{ $txt }}"
                            </p>
                        </div>
                        <table id="testTB" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                            <tr>
                                <th scope="col">Mã thiết bị</th>
                                <th scope="col">Tên thiết bị</th>
                                <th scope="col">Chủng loại</th>
                                <th scope="col">Thông tin thiết bị</th>
                                <th scope="col">Nhóm</th>
                                <th scope="col">Phòng</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($devices as $device)
                                <tr>
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
                                        <p class="text-dark font-size-14 mb-0"
                                           style=" white-space: nowrap;
                                            width: 150px;
                                            overflow: hidden;
                                            text-overflow: ellipsis;"
                                        >{{ $device->device_info }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">@if($device->device_group_id != 0) {{ $device->DeviceGroup->name }} @else
                                                Chưa có nhóm @endif</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">
                                            @if($device->room_id != null)
                                                {{ $device->Room->name }}
                                            @endif
                                        </p>
                                    </td>
                                    <td style="text-align: center !important;">
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
                                           href="{{ route('device.edit',['id' => $device->id]) }}"
                                        >Sửa</a>

                                        <a href="
                                        @if($device->device_group_id != 0)
                                        {{ route('device.detail-wg', ['id' => $device->id, 'group_id' => $device->device_group_id ]) }}
                                        @else
                                        {{ route('device.detail', ['id' => $device->id ]) }}
                                        @endif"
                                           class="btn btn-danger badge badge-danger font-size-14"
                                        >Xem chi tiết</a>
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
    <script src="{{ asset('assets\apps\assets\libs\select2\js\select2.min.js') }}"></script>

    <!-- form advanced init -->
    <script src="{{ asset('assets\apps\assets\js\pages\form-advanced.init.js') }}"></script>

    {{--    <script src="{{ asset('js/axios.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('js/menu-create.js') }}"></script>--}}
    <script>
        this.toggleInput = function () {
            var value = document.getElementById("key").value;

            if (value === 'category') {
                // document.getElementById('device_only').classList.add('d-none');
                document.getElementById('with_cate').classList.remove('d-none');
                document.getElementById('with_room').classList.add('d-none');
            } else if (value === 'room') {
                // document.getElementById('device_only').classList.add('d-none');
                document.getElementById('with_cate').classList.add('d-none');
                document.getElementById('with_room').classList.remove('d-none');
            } else {
                // document.getElementById('device_only').classList.add('d-none');
                document.getElementById('with_cate').classList.add('d-none');
                document.getElementById('with_room').classList.add('d-none');
            }
        };

        this.toggleInput();

        document.getElementById("key").onchange = function () {
            self.toggleInput();
        };
    </script>
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
    <script>
        $(document).ready(function () {
            $('#testTB').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    'colvis'
                ],
            });
        });
    </script>
@endsection
