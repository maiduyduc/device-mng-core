@extends('apps.layouts.app')

@section('title')
    <title>Thêm người dùng</title>
@endsection
@section('link')
    <link href="{{ asset('assets\apps\assets\libs\select2\css\select2.min.css') }}" rel="stylesheet" type="text/css">

@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Thêm người dùng</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Danh sách người dùng</a></li>
                            <li class="breadcrumb-item active">Thêm người dùng</li>
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
                        <div class="col-lg-6">
                            <form method="post" action="{{ route('user.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="formrow-name-input">Tên người dùng</label>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="formrow-name-input"
                                           placeholder="Nhập tên người dùng"
                                           value="{{ old('name') }}"
                                           required="">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="formrow-email-input">Email</label>
                                    <input type="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}"
                                           placeholder="Nhập Email"
                                           id="formrow-email-input" required="">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="formrow-password-input">Mật khẩu</label>
                                    <input type="password" name="password"
                                           placeholder="Nhập mật khẩu"
                                           class="form-control @error('password') is-invalid @enderror"
                                           id="formrow-password-input" required="">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Vai trò</label>
                                    <select name="role_id[]" class="form-control select2-search-disable select2-init"
                                            multiple>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Tạo tài khoản</button>
                                    <a href="{{ route('user.index') }}" class="btn btn-danger w-md">Hủy</a>
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
    <script src="{{ asset('assets\apps\assets\libs\select2\js\select2.min.js') }}"></script>

    <!-- form advanced init -->
    <script src="{{ asset('assets\apps\assets\js\pages\form-advanced.init.js') }}"></script>
    <script>
        $('.select2-init').select2({
            'placeholder': 'Chọn vai trò',
        })
    </script>
@endsection
