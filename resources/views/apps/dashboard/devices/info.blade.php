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
                    <h4 class="mb-0 font-size-18">Thông tin thiết bị</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Thiết bị</a></li>
                            <li class="breadcrumb-item active">Thông tin thiết bị</li>
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
                        <div class="media">
                            <div class="media-body overflow-hidden">
                                <h5 class="text-truncate font-size-16">{{ $devices[0]->device_name }}</h5>
                                <p class="text-muted">
                                    @if($devices[0]->room_id != null) Phòng: {{ $devices[0]->Room->name }} @else Chưa sử
                                    dụng @endif
                                    @if($devices[0]->device_group_id != null) |
                                    Nhóm: {{ $devices[0]->DeviceGroup->name }} @else | Không có nhóm @endif
                                </p>
                            </div>
                        </div>

                        <h5 class="font-size-15 mt-4">Thông tin thiết bị :</h5>

                        <div class="text-muted mt-4">
                            <p><i class="mdi mdi-chevron-right text-primary mr-1"></i>
                                Mã quản lý: {{ $devices[0]->full_number }}
                            </p>
                            <p><i class="mdi mdi-chevron-right text-primary mr-1"></i>
                                @if($devices[0]->serial != null) Số serial: {{ $devices->serial }} @else Không có số
                                Serial @endif
                            </p>
                            <p><i class="mdi mdi-chevron-right text-primary mr-1"></i>
                                @if($devices[0]->device_info != null) {{ $devices[0]->device_info }} @else Không có
                                thông
                                tin cấu hình @endif
                            </p>
                        </div>

                        <div class="row task-dates" style="text-align: center">
                            <div class="col-sm-4 col-4">
                                <div class="mt-4">
                                    <h5 class="font-size-14"><i class="bx bx-dollar mr-1 text-primary"></i>
                                        Giá
                                    </h5>
                                    <p class="text-muted mb-0">{{ number_format($devices[0]->price)  }} VNĐ</p>
                                </div>
                            </div>
                            <div class="col-sm-4 col-4">
                                <div class="mt-4">
                                    <h5 class="font-size-14"><i class="bx bx-calendar mr-1 text-primary"></i>
                                        Ngày nhập
                                    </h5>
                                    <p class="text-muted mb-0">{{ $devices[0]->created_at }}</p>
                                </div>
                            </div>

                            <div class="col-sm-4 col-4">
                                <div class="mt-4">
                                    <h5 class="font-size-14"><i class="bx bx-calendar-check mr-1 text-primary"></i>
                                        Cập nhật mới nhất
                                    </h5>
                                    <p class="text-muted mb-0">{{ $devices[0]->updated_at }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($devices[0]->device_group_id != null)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">Thiết bị cùng nhóm</div>
                                    <table id="" class="table table-striped table-bordered dt-responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Mã thiết bị</th>
                                            <th scope="col">Tên thiết bị</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Hành động</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($groups as $group)
                                            <tr>
                                                <td>
                                                    <p class="text-dark font-size-14 mb-0">{{ $i }}</p>
                                                    <p style="display: none;">{{ $i++ }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-dark font-size-14 mb-0">{{ $group->full_number }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-dark font-size-14 mb-0">{{ $group->device_name }}</p>
                                                </td>
                                                <td style="text-align: center !important;">
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle font-size-14" href="#" role="button"
                                                           data-toggle="dropdown" aria-haspopup="true"
                                                           aria-expanded="false">
                                                            <p class="text-dark font-size-14 mb-0">
                                            <span class="font-size-14 badge badge-soft-{{ $group->status }}"
                                                  style="max-width: 20rem">
                                            @foreach(config('status.device') as $status => $item)
                                                    @if($status == $group->status)
                                                        {{ $item }}
                                                    @endif
                                                @endforeach
                                            </span>
                                                            </p>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="
                                        @if($group->device_group_id != 0)
                                                    {{ route('device.detail-wg', ['id' => $group->id, 'group_id' => $group->device_group_id ]) }}
                                                    @else
                                                    {{ route('device.detail', ['id' => $group->id ]) }}
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
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        Lịch sử thiết bị
                                    </div>
                                    <table id="" class="table table-striped table-bordered dt-responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th scope="col">Nội dung sửa đổi</th>
                                            <th scope="col">Ngày sửa đổi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($history as $his)
                                            <tr>
                                                <td>
                                                    <p class="text-dark font-size-14 mb-0">{{ $his->note }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-dark font-size-14 mb-0">{{ $his->date_modified }}</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div> <!-- end col -->
            <div class="col-md-12">
                <input
                    onclick="window.history.go(-1); return false;"
                    type="submit"
                    style="width: 100%"
                    class="btn btn-danger w-md"
                    value="Trở về"
                />
            </div>
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
@endsection
