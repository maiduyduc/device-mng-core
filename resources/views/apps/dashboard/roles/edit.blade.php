@extends('layouts.app')

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Vai trò</a></li>
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
                            <form method="post" action="{{ route('role.update', ['id' => $role->id]) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="formrow-firstname-input">Tên vai trò</label>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="formrow-firstname-input"
                                           placeholder="Nhập tên vai trò"
                                           value="{{ $role->name }}"
                                           required="">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="formrow-display-name-input">Tên hiển thị</label>
                                    <input type="text" name="display_name"
                                           class="form-control @error('display_name') is-invalid @enderror"
                                           value="{{ $role->display_name }}"
                                           placeholder="Nhập tên hiển thị"
                                           id="formrow-display-name-input" required="">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="card border border-primary mb-3 col-md-12 card2"
                                                 style="padding: 0; ">
                                                <div class="card-header"
                                                     style="border-radius: 0.25rem;">
                                                    <div
                                                        class="custom-control custom-checkbox custom-checkbox-primary"
                                                        style="padding-left: 22px;">
                                                        <input type="checkbox"
                                                               class="custom-control-input checkall"
                                                               id="checkall">
                                                        <label class="custom-control-label text-danger"
                                                               style="font-size: 14px"
                                                               for="checkall">
                                                            Chọn tất cả
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        @foreach($permissionParent as $permission)
                                            <div class="row">
                                                <div class="card border border-primary mb-3 col-md-12 card2"
                                                     style="padding: 0; ">
                                                    <div class="card-header"
                                                         style="border-top-left-radius: 0.25rem; border-top-right-radius: 0.25rem;">
                                                        <div
                                                            class="custom-control custom-checkbox custom-checkbox-primary"
                                                            style="padding-left: 22px;">
                                                            <input type="checkbox"
                                                                   class="custom-control-input checkbox_wrapper"
                                                                   id="box{{ $permission->id }}">
                                                            <label class="custom-control-label text-info"
                                                                   style="font-size: 14px"
                                                                   for="box{{ $permission->id }}">
                                                                Module {{ $permission->display_name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="padding-left: 10px">
                                                        @foreach($permission->permissionChildren as $item)
                                                            <div class="card-body text-dark col-md-3">
                                                                <div
                                                                    class="custom-control custom-checkbox custom-checkbox-primary">
                                                                    <input name="permission_id[]" type="checkbox"
                                                                           {{ $permissionsChecked->contains('id', $item->id) ? ' checked' : '' }}
                                                                           class="custom-control-input checkbox_childrent"
                                                                           id="item{{ $item->id }}"
                                                                           value="{{ $item->id }}">
                                                                    <label class="custom-control-label"
                                                                           for="item{{ $item->id }}">
                                                                        {{ $item->display_name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Đồng ý</button>
                                    <a href="{{ route('role.index') }}" class="btn btn-danger w-md">Hủy</a>
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
