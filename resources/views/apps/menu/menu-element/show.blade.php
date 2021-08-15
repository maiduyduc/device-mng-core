@extends('apps.layouts.app')

@section('title')
    <title>Thông tin menu</title>
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
            font-weight: bold;
            font-size: 14px;
        }
    </style>
    <link href="{{ asset('assets\apps\assets\libs\select2\css\select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Thông tin menu</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý menu con</a></li>
                            <li class="breadcrumb-item active">Thông tin menu</li>
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

                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <colgroup>
                                    <col span="1" style="width: 300px;">
                                    <col span="1">
                                </colgroup>
                                <thead>

                                </thead>
                                <tbody>
                                <tr>
                                    <td>Menu</td>
                                    <td>
                                        @foreach($menulist as $menu1)
                                            @if($menu1->id == $menuElement->menu_id  )
                                                {{ $menu1->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tên menu</td>
                                    <td>
                                        {{ $menuElement->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Role được phép truy cập</td>
                                    <td>
                                        <?php
                                        $first = true;
                                        foreach($menuroles as $menurole){
                                            if($first === true){
                                                $first = false;
                                            }else{
                                                echo ', ';
                                            }
                                            echo $menurole->role_name;
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Loại</td>
                                    <td>
                                        {{ $menuElement->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <td> Href</td>
                                    <td>{{ $menuElement->href }}</td>
                                </tr>
                                <tr>
                                    <td>Menu cha:</td>
                                    <td>
                                        <?php
                                        if(isset($menuElement->parent_name)){
                                            echo $menuElement->parent_name;
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Icon</td>
                                    <td>
                                        <i class="{{ $menuElement->icon }}"></i>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        {{ $menuElement->icon }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <a class="btn btn-primary" style="width: 100%" href="{{ route('menu.index', ['menu' => $menuElement->menu_id]) }}">Trở về</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
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
    <script
        src="{{ asset('assets\apps\assets\libs\datatables.net-responsive\js\dataTables.responsive.min.js') }}"></script>
    <script
        src="{{ asset('assets\apps\assets\libs\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets\apps\assets\js\pages\datatables.init.js') }}"></script>

@endsection
