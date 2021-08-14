@extends('layouts.app')

@section('title')
    <title>Danh sách dự trù</title>
@endsection
@section('link')
    <link href="{{ asset('assets\libs\datatables.net-bs4\css\dataTables.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css">
    <link href="{{ asset('assets\libs\datatables.net-buttons-bs4\css\buttons.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css">
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets\libs\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css') }}"
          rel="stylesheet"
          type="text/css">
    <style>
        th, td {
            vertical-align: middle !important;
            text-align: center !important;
        }

        .badge-soft-accept {
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
        @if(session('msg'))
            <script>alert("{{ session('msg') }}")</script>
    @endif
    <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Danh sách dự trù</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Cấp phát</a></li>
                            <li class="breadcrumb-item active">Danh sách dự trù</li>
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
                                        <a href="{{ route('device-plan.create') }}" class="btn btn-primary">Tạo mới</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col" style="width: 50px">Mã văn bản</th>
                                <th scope="col">Số lượng thiết bị</th>
                                <th scope="col">Ghi chú</th>
                                <th scope="col" style="max-width: 5rem">Trạng thái</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col" style="width: 100px">Hành động</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($device_plans as $items)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <p style="display: none">{{ $i++ }}</p>
                                    <td>{{ $items->full_number }}</td>
                                    <td>{{ $items->qty }}</td>
                                    <td>{{ $items->note }}</td>
                                    <td>
                                        <span class="font-size-14 badge badge-soft-{{ $items->status }}"
                                              style="max-width: 20rem">
                                        @foreach(config('status.status') as $status => $item)
                                                @if($status == $items->status)
                                                    {{ $item }}
                                                @endif
                                        @endforeach
                                        </span>
                                        @if($items->is_export == 1)
                                            <span class="font-size-14 badge badge-soft-{{ $items->status }}"
                                                  style="max-width: 20rem">Đã xuất thông tin
                                                @endif
                                        </span>
                                    </td>
                                    <td>{{ $items->created_at }}</td>
                                    <td>
                                        <a class="btn btn-primary badge badge-primary font-size-14"
                                           style="@if($items->status == 'accept' || $items->status == 'cancel') display:none @endif"
                                           href="{{ route('device-plan.edit',['id'=>$items->id]) }}">Sửa</a>
                                        <a href=""
                                           style="@if($items->status == 'accept' || $items->status == 'cancel') display:none @endif"
                                           class="btn btn-danger badge badge-danger font-size-14 action_delete"
                                           data-url="{{ route('device-plan.delete', ['id'=>$items->id]) }}"
                                        >Xóa</a>
                                        <a href="{{ route('device-plan.info', ['id'=>$items->id]) }}"
                                           style="@if($items->status == 'accept' || $items->status == 'cancel') width:100% @endif"
                                           class="btn btn-info badge badge-info font-size-14">Xem chi tiết</a>
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
    <script src="{{ asset('assets\libs\datatables.net\js\jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets\libs\datatables.net-bs4\js\dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets\libs\datatables.net-buttons\js\dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets\libs\datatables.net-buttons-bs4\js\buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets\libs\jszip\jszip.min.js') }}"></script>
    <script src="{{ asset('assets\libs\pdfmake\build\pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets\libs\pdfmake\build\vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets\libs\datatables.net-buttons\js\buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets\libs\datatables.net-buttons\js\buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets\libs\datatables.net-buttons\js\buttons.colVis.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('assets\libs\datatables.net-responsive\js\dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets\libs\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets\js\pages\datatables.init.js') }}"></script>

    <script src="{{ asset('js/delete.js') }}"></script>
@endsection
