@extends('apps.layouts.app')

@section('title')
    <title>Kiểm kê trên số</title>
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
    </style>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Thông tin kiểm kê</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kiểm kê</a></li>
                            <li class="breadcrumb-item active">Kiểm kê trên số</li>
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
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                            <tr>
                                <th rowspan="2">TT</th>
                                <th rowspan="2" style="width: 200px">Tên tài sản</th>
                                <th rowspan="2">Mã quản lý</th>
                                <th rowspan="2">Số seri</th>
                                <th rowspan="2">Ngày mua</th>
                                <th rowspan="2">ĐVT</th>
                                <th rowspan="1" colspan="2">Theo sổ sách</th>
                                <th rowspan="1" colspan="2">Theo kiểm kê</th>
                                <th rowspan="2" style="width: 100px">Nguồn <br> tiền</th>
                                <th rowspan="2" style="width: 100px">Giá trị <br> ước tính</th>
                                <th rowspan="2">Ghi chú</th>
                            </tr>
                            <tr>
                                <th>SL</th>
                                <th>Nguyên giá</th>
                                <th>SL</th>
                                <th>Nguyên giá</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr>
                                    <td>
                                        {{ $i }}
                                        <p style="display: none">{{ $i++ }}</p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">
                                            {{ $data->device_name }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">
                                            {{ $data->device_code }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">
                                            {{ $data->serial }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">
                                            {{ $data->date_purchase }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">
                                            {{ $data->unit }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">
                                            {{ $data->qty_document }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">
                                            {{ number_format($data->price_document)  }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">
                                            {{ $data->qty_inventory }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">
                                            {{ number_format($data->price_inventory)  }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">
                                            {{ $data->funds }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">
                                            {{ number_format($data->estimate_price)  }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0 text-over">
                                            {{ $data->note }}
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
{{--                                <a href="{{ route('inventory.index') }}" style="width: 100%"--}}
{{--                                   class="btn btn-danger w-md">Trở về</a>--}}
                                <input
                                    onclick="window.history.go(-1); return false;"
                                    type="submit"
                                    style="width: 100%"
                                    class="btn btn-danger w-md"
                                    value="Trở về"
                                />
                            </div>

                        </div>
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
    <script src="{{ asset('assets\apps\assets\libs\admin-resources\rwd-table\rwd-table.min.js') }} "></script>

    <!-- Init js -->
    <script src="{{ asset('assets\apps\assets\js\pages\table-responsive.init.js') }}"></script>
    <script
        src="{{ asset('assets\apps\assets\libs\datatables.net-responsive\js\dataTables.responsive.min.js') }}"></script>
    <script
        src="{{ asset('assets\apps\assets\libs\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets\apps\assets\js\pages\datatables.init.js') }}"></script>
    <!-- delete ajax -->
{{--    <script>--}}
{{--        let elements = document.querySelectorAll("*[id]");--}}
{{--        let usedIds = {};--}}

{{--        for (let i = 0; i < elements.length; i++) {--}}
{{--            const id = elements[i].getAttribute("id");--}}
{{--            if (usedIds[id]) {--}}
{{--                elements[i].parentNode.removeChild(elements[i]);--}}
{{--            } else {--}}
{{--                usedIds[id] = true;--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}
@endsection
