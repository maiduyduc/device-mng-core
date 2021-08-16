@extends('apps.layouts.app')

@section('title')
    <title>Danh sách người dùng</title>
@endsection
@section('link')
    <link href="{{ asset('assets\apps\assets\apps\assets\libs\datatables.net-bs4\css\dataTables.bootstrap4.min.css') }}"
          rel="stylesheet"
          type="text/css">
    <link href="{{ asset('assets\apps\assets\apps\assets\libs\datatables.net-buttons-bs4\css\buttons.bootstrap4.min.css') }}"
          rel="stylesheet"
          type="text/css">
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets\apps\assets\apps\assets\libs\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css') }}"
          rel="stylesheet" type="text/css">
    <style>
        th {
            vertical-align: middle !important;
            text-align: center !important;
        }

        .badge-soft-admin {
            color: #f46a6a;
            background-color: rgba(244, 106, 106, .18);
        }

        .badge-soft-ptb {
            color: #556ee6;
            background-color: rgba(85, 110, 230, .18);
        }

        .badge-soft-trk {
            color: #34c38f;
            background-color: rgba(52, 195, 143, .18);
        }

        .badge-soft-ktv {
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
                    <h4 class="mb-0 font-size-18">Danh sách người dùng</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Người dùng</a></li>
                            <li class="breadcrumb-item active">Danh sách người dùng</li>
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
                                    {{--                                    <div class="page-title-right">--}}
                                    {{--                                        <a href="{{ route('user.create') }}" class="btn btn-primary">Tạo tài khoản--}}
                                    {{--                                            mới</a>--}}
                                    {{--                                        <a href="{{ route('user.trash') }}" class="btn btn-danger"--}}
                                    {{--                                           data-toggle="tooltip" data-placement="top" title=""--}}
                                    {{--                                           data-original-title="Thùng rác"--}}
                                    {{--                                        >--}}
                                    {{--                                            <i class="bx bx-trash"></i>--}}
                                    {{--                                        </a>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
                        </div>

                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th scope="col" style="width: 50px">ID</th>
                                <th>Tên người dùng</th>
                                <th>Email</th>
                                <th style="max-width: 3rem">Vai trò</th>
                                <th scope="col" style="width: 100px">Hành động</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td style="text-align: center !important;">{{ $user->id }}</td>
                                    <td>
                                        <p class="text-dark font-size-14 mb-0">{{ $user->name }}</p>
                                    </td>
                                    <td><p class="text-dark font-size-14 mb-0">{{ $user->email }}</p></td>
                                    <td style="text-align: center !important;">
                                        <span class="badge badge-soft-{{ $user->menuroles }} font-size-14">
                                            @foreach(config('my-config.role-name') as $role => $name)
                                                @if($role == $user->menuroles)
                                                    {{ $name }}
                                                @endif
                                            @endforeach
                                            </span>
                                    </td>

                                    <td class="d-flex justify-content-around">
                                        @if( $you->id !== $user->id )
                                            <a href="{{ url('/users/' . $user->id . '/edit') }}"
                                               class="btn btn-primary badge badge-primary font-size-14">Sửa</a>
                                            <form action="{{ route('users.destroy', $user->id ) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger badge badge-danger  font-size-14">Xóa tài
                                                    khoản
                                                </button>
                                            </form>
                                        @endif
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
    <script src="{{ asset('assets\apps\assets\apps\assets\libs\datatables.net\js\jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\apps\assets\libs\datatables.net-bs4\js\dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets\apps\assets\apps\assets\libs\datatables.net-buttons\js\dataTables.buttons.min.js') }}"></script>
    <script
        src="{{ asset('assets\apps\assets\apps\assets\libs\datatables.net-buttons-bs4\js\buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\apps\assets\libs\jszip\jszip.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\apps\assets\libs\pdfmake\build\pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\apps\assets\libs\pdfmake\build\vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\apps\assets\libs\datatables.net-buttons\js\buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\apps\assets\libs\datatables.net-buttons\js\buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\apps\assets\libs\datatables.net-buttons\js\buttons.colVis.min.js') }}"></script>

    <!-- Responsive examples -->
    <script
        src="{{ asset('assets\apps\assets\apps\assets\libs\datatables.net-responsive\js\dataTables.responsive.min.js') }}"></script>
    <script
        src="{{ asset('assets\apps\assets\apps\assets\libs\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets\apps\assets\apps\assets\js\pages\datatables.init.js') }}"></script>

    <script src="{{ asset('assets\apps\assets\apps\js\delete.js') }}"></script>
@endsection
