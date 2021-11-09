@extends('apps.layouts.app')

@section('title')
    <title>Danh sách thanh lý</title>
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
                    <h4 class="mb-0 font-size-18">Danh sách thanh lý</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Thanh lý</a></li>
                            <li class="breadcrumb-item active">Danh sách thanh lý</li>
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
                                            <a class="btn btn-info" data-toggle="modal" id="getMessage"
                                               data-target="#messageBoard" data-url="{{ url('liquidateDevice')}}"
                                               href="#!"> Thêm mới </a>
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
                                <th scope="col">Số lượng thiết bị</th>
                                <th scope="col">Ghi chú</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col" style="width: 170px">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($liquidates as $liquidate)
                                <tr>
                                    <td>
                                        {{ $i }}
                                        <p style="display: none"> {{ $i++ }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">{{ $liquidate->full_number }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over" style="max-width: 1rem">
                                            {{ $liquidate->qty }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">{{ $liquidate->note }}</p>
                                    </td>
                                    <td>
                                        <span class="font-size-14 badge badge-soft-{{ $liquidate->status }}"
                                              style="max-width: 20rem">
                                            @foreach(config('status.liquidate') as $status => $item)
                                                @if($status == $liquidate->status)
                                                    {{ $item }}
                                                @endif
                                            @endforeach
                                        </span>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">
                                            {{ date_format($liquidate->updated_at,"d/m/Y")  }}
                                        </p>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            @if(Auth::user()->menuroles == 'ktv' || Auth::user()->menuroles == 'sadmin')
                                            <a class="btn btn-primary badge badge-primary font-size-14"
                                               style=" @if($liquidate->can_edit == 0) display:none @endif"
                                               href="{{ route('liquidate.edit', ['id'=>$liquidate->id]) }}">Sửa</a>
                                            <a href=""
                                               style=" @if($liquidate->can_edit == 0) display:none @endif"
                                               class="btn btn-danger badge badge-danger font-size-14 action_delete"
                                               data-url="{{ route('liquidate.delete', ['id'=>$liquidate->id]) }}"
                                            >Xóa</a>
                                            @endif
                                            <a class="btn btn-info badge badge-info font-size-14"
                                               style=" @if($liquidate->can_edit == 0) width:100% @endif"
                                               href="{{ route('liquidate.info', ['id'=>$liquidate->id]) }}">Xem chi
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
    <script src="{{ asset('assets/apps/js/delete_v2.js') }}"></script>
@endsection
