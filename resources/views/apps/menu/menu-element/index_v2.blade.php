@extends('apps.layouts.app')

@section('title')
    <title>Quản lý menu con</title>
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
    </style>
    <link href="{{ asset('assets\apps\assets\libs\select2\css\select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <?php

    function renderDropdownForMenuEdit($data, $role){
    if(array_key_exists('slug', $data) && $data['slug'] === 'dropdown'){
    ?>
    <tr>
{{--        <td>{{ $data['id'] }}</td>--}}
        <td>{{ $data['sequence'] }}</td>
        <td>
            <p class="text-dark font-size-14 mb-0">{{ $data['name']}}</p>
        </td>
        <td>{{ $data['slug'] }}</td>
        <td></td>
{{--        <td>{{ $data['sequence'] }}</td>--}}
        <td>
            <a class="btn btn-success" href="{{ route('menu.up', ['id' => $data['id']]) }}">
                <i class="mdi mdi-arrow-up-bold-outline"></i>
            </a>
        </td>
        <td>
            <a class="btn btn-success" href="{{ route('menu.down', ['id' => $data['id']]) }}">
                <i class="mdi mdi-arrow-down-bold-outline"></i>
            </a>
        </td>
        <td style="min-width: 7rem; text-align: center!important;">
            <a href="{{ route('menu.show', ['id' => $data['id']]) }}"
               class="btn btn-info badge badge-info font-size-14">Xem chi tiết
            </a>
            <a href="{{ route('menu.edit', ['id' => $data['id']]) }}"
               class="btn btn-primary badge badge-primary font-size-14">Sửa
            </a>
            <a href=""
               class="btn btn-danger badge badge-danger font-size-14 action_delete"
               data-url="{{ route('menu.delete', ['id' => $data['id']]) }}"
            >Xóa</a>
        </td>
    </tr>
    <?php
    renderDropdownForMenuEdit($data['elements'], $role);
    }else{
    for($i = 0; $i < count($data); $i++){
    if( $data[$i]['slug'] === 'link' ){
    ?>
    <tr>
{{--        <td>{{ $data[$i]['id'] }}</td>--}}
        <td>{{ $data[$i]['sequence'] }}</td>
        <td>
            <p class="text-dark font-size-14 mb-0">{{ $data[$i]['name']}}</p>
        </td>
        <td>{{ $data[$i]['slug'] }}</td>
        <td>{{ $data[$i]['href'] }}</td>
{{--        <td>{{ $data[$i]['sequence'] }}</td>--}}
        <td>
            <a class="btn btn-success" href="{{ route('menu.up', ['id' => $data[$i]['id']]) }}">
                <i class="mdi mdi-arrow-up-bold-outline"></i>
            </a>
        </td>
        <td>
            <a class="btn btn-success" href="{{ route('menu.down', ['id' => $data[$i]['id']]) }}">
                <i class="mdi mdi-arrow-down-bold-outline"></i>
            </a>
        </td>
        <td style="min-width: 7rem; text-align: center!important;">
            <a href="{{ route('menu.show', ['id' => $data[$i]['id']]) }}"
               class="btn btn-info badge badge-info font-size-14">Xem chi tiết
            </a>
            <a href="{{ route('menu.edit', ['id' => $data[$i]['id']]) }}"
               class="btn btn-primary badge badge-primary font-size-14">Sửa
            </a>
            <a href=""
               class="btn btn-danger badge badge-danger font-size-14 action_delete"
               data-url="{{ route('menu.delete', ['id' => $data[$i]['id']]) }}"
            >Xóa</a>
        </td>
    </tr>
    <?php
    }elseif ($data[$i]['slug'] === 'dropdown') {
        renderDropdownForMenuEdit($data[$i], $role);
    }
    }
    }
    }
    ?>

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Danh sách menu con</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý menu con</a></li>
                            <li class="breadcrumb-item active">Danh sách menu con</li>
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
                                    <div class="col-md-6 p-0">
                                        <form action="{{ route('menu.index') }}" methos="GET">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <select class="form-control select2-search-disable select2-init" name="menu">
                                                        @foreach($menulist as $menu1)
                                                            @if($menu1->id == $thisMenu)
                                                                <option value="{{ $menu1->id }}"
                                                                        selected>{{ $menu1->name }}</option>
                                                            @else
                                                                <option
                                                                    value="{{ $menu1->id }}">{{ $menu1->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    <button type="submit" style="width: 85px" class="btn btn-primary">
                                                        Đổi menu
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="page-title-right">
                                        <a href="{{ route('menu.create') }}" class="btn btn-primary">
                                            Thêm menu mới
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                            <tr>
{{--                                <th scope="col" style="width: 50px">ID</th>--}}
                                <th scope="col">Thứ tự ưu tiên</th>
                                <th>Tên Menu</th>
                                <th scope="col">Loại</th>
                                <th scope="col">Đường dẫn</th>
{{--                                <th scope="col">Thứ tự ưu tiên</th>--}}
                                <th scope="col">Tăng cấp ưu tiên</th>
                                <th scope="col">Giảm cấp ưu tiên</th>
                                <th scope="col" style="max-width: 6rem">Hành động</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($menuToEdit as $menuel)
                                @if($menuel['slug'] === 'link')
                                    <tr>
{{--                                        <td>{{ $menuel['id'] }}</td>--}}
                                        <td>{{ $menuel['sequence'] }}</td>
                                        <td>
                                            <p class="text-dark font-size-14 mb-0">{{ $menuel['name']}}</p>
                                        </td>
                                        <td>{{ $menuel['slug'] }}</td>
                                        <td>{{ $menuel['href'] }}</td>
{{--                                        <td>{{ $menuel['sequence'] }}</td>--}}
                                        <td>
                                            <a class="btn btn-success"
                                               href="{{ route('menu.up', ['id' => $menuel['id']]) }}">
                                                <i class="mdi mdi-arrow-up-bold-outline"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-success"
                                               href="{{ route('menu.down', ['id' => $menuel['id']]) }}">
                                                <i class="mdi mdi-arrow-down-bold-outline"></i>
                                            </a>
                                        </td>
                                        <td style="min-width: 7rem; text-align: center!important;">
                                            <a href="{{ route('menu.show', ['id' => $menuel['id']]) }}"
                                               class="btn btn-info badge badge-info font-size-14">Xem chi tiết
                                            </a>
                                            <a href="{{ route('menu.edit', ['id' => $menuel['id']]) }}"
                                               class="btn btn-primary badge badge-primary font-size-14">Sửa
                                            </a>
                                            <a href=""
                                               class="btn btn-danger badge badge-danger font-size-14 action_delete"
                                               data-url="{{ route('menu.delete', ['id' => $menuel['id']]) }}"
                                            >Xóa</a>
                                        </td>
                                    </tr>
                                @elseif($menuel['slug'] === 'dropdown')
                                    <?php renderDropdownForMenuEdit($menuel, $role) ?>
                                @elseif($menuel['slug'] === 'title')
                                    <tr>
{{--                                        <td>{{ $menuel['id'] }}</td>--}}
                                        <td>{{ $menuel['sequence'] }}</td>
                                        <td>
                                            <p class="text-dark font-size-14 mb-0">{{ $menuel['name']}}</p>
                                        </td>
                                        <td>{{ $menuel['slug'] }}</td>
                                        <td></td>
{{--                                        <td>{{ $menuel['sequence'] }}</td>--}}
                                        <td>
                                            <a class="btn btn-success"
                                               href="{{ route('menu.up', ['id' => $menuel['id']]) }}">
                                                <i class="mdi mdi-arrow-up-bold-outline"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-success"
                                               href="{{ route('menu.down', ['id' => $menuel['id']]) }}">
                                                <i class="mdi mdi-arrow-down-bold-outline"></i>
                                            </a>
                                        </td>
                                        <td style="min-width: 7rem; text-align: center!important;">
                                            <a href="{{ route('menu.show', ['id' => $menuel['id']]) }}"
                                               class="btn btn-info badge badge-info font-size-14">Xem chi tiết
                                            </a>
                                            <a href="{{ route('menu.edit', ['id' => $menuel['id']]) }}"
                                               class="btn btn-primary badge badge-primary font-size-14">Sửa
                                            </a>
                                            <a href=""
                                               class="btn btn-danger badge badge-danger font-size-14 action_delete"
                                               data-url="{{ route('menu.delete', ['id' => $menuel['id']]) }}"
                                            >Xóa</a>
                                        </td>
                                    </tr>
                                @endif
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

    <script src="{{ asset('assets\apps\js\delete.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\libs\select2\js\select2.min.js') }}"></script>
    <script>
        $('.select2_init').select2({
            'placeholder' : 'Chọn vai trò'
        })
    </script>
    <!-- form advanced init -->
    <script src="{{ asset('assets\apps\assets\js\pages\form-advanced.init.js') }}"></script>
@endsection
