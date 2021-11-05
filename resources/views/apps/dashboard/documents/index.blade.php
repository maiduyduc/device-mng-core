@extends('apps.layouts.app')

@section('title')
    <title>Chứng từ mua sắm</title>
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

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Chứng từ mua sắm</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Cấp phát</a></li>
                            <li class="breadcrumb-item active">Chứng từ mua sắm</li>
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
                                        @if(Auth::user()->menuroles == 'ptb')
                                            <a class="btn btn-info" data-toggle="modal" id="getMessage"
                                               data-target="#messageBoard" data-url="{{ url('ajax-device-plan')}}"
                                               href="#!"> Nhập từ phiếu dự trù </a>
                                            <a href="{{ route("document.create") }}" class="btn btn-primary">Thêm mới</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="testTB" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col" style="">Mã chứng từ</th>
                                <th scope="col" style="">Mã văn bản dự trù <br> (nếu có)</th>
                                <th scope="col" style="">Số lượng thiết bị</th>
                                <th scope="col" style="max-width: 10rem">Trạng thái</th>
                                <th scope="col" style="">Ngày tạo</th>
                                <th scope="col" style="max-width: 5rem">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($documents as $document)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <p style="display: none">{{ $i++ }}</p>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">
                                            {{ $document->full_number }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">
                                            {{ $document->code }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over" style="max-width: 20rem">
                                            {{ $document->qty }}
                                        </p>
                                    </td>
                                    <td>
                                        <span class="font-size-14 badge badge-soft-{{ $document->status }}"
                                              style="max-width: 10rem">
                                            @foreach(config('status.status') as $status => $item)
                                                @if($status == $document->status)
                                                    {{ $item }}
                                                @endif
                                            @endforeach
                                        </span>
                                        @if($document->is_export == 1)
                                            <span class="font-size-14 badge badge-soft-{{ $document->status }}"
                                                  style="max-width: 20rem">Đã tạo phiếu bàn giao
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">
                                            {{ date_format($document->updated_at,"d/m/Y")  }}
                                        </p>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            @if(Auth::user()->menuroles == 'ptb')
                                            <a class="btn btn-primary badge badge-primary font-size-14"
                                               style="@if($document->can_edit == 0) display:none @endif"
                                               href="{{ route('document.edit', ['id'=>$document->id]) }}">Sửa</a>
                                            <a href=""
                                               style="@if($document->status == 'accept' || $document->status == 'cancel') display:none @endif"
                                               class="btn btn-danger badge badge-danger font-size-14 action_delete"
                                               data-url="{{ route('document.delete', ['id'=>$document->id]) }}"
                                            >Xóa</a>
                                            @endif
                                            <a class="btn btn-info badge badge-info font-size-14"
                                               href="{{ route('document.info', ['id'=>$document->id]) }}">Xem chi
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

    <script src="{{ asset('/assets/apps/js/delete_v2.js') }}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#testTB').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    },
                    'colvis'
                ]
            } );
        } );
    </script>
@endsection
