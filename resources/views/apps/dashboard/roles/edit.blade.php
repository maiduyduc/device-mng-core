@extends('apps.layouts.app')

@section('title')
    <title>Sửa vai trò</title>
@endsection
@section('link')
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Sửa vai trò</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý vai trò</a></li>
                            <li class="breadcrumb-item active">Sửa vai trò</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12">
                            <form method="post" action="{{ route('roles.update', $role->id) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $role->id }}"/>
                                <div class="form-group">
                                    <label for="formrow-name-input">Tên vai trò</label>
                                    <input type="text" name="name"
                                           class="form-control"
                                           id="formrow-name-input"
                                           placeholder="Nhập tên vai trò"
                                           value="{{ $role->name }}"
                                           required="">
                                </div>
                                <div class="form-group">
                                    <label for="formrow-display-name-input">Tên hiển thị</label>
                                    <input type="text" name="display_name"
                                           class="form-control"
                                           value="{{ $role->display_name }}"
                                           placeholder="Nhập tên hiển thị"
                                           id="formrow-display-name-input" required="">
                                </div>
                                <div class="d-flex justify-content-around">
                                    <div class="col-md-6"><button type="submit" style="width: 100%" class="btn btn-primary w-md">Đồng ý</button></div>
                                    <div class="col-md-6"><a href="{{ route('roles.index') }}" style="width: 100%" class="btn btn-danger w-md">Hủy</a></div>
                                </div>
                            </form>
                            <div class="col-lg-6">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js\roles\js\checkbox.js') }}"></script>
@endsection
