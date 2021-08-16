@extends('apps.layouts.app')

@section('title')
    <title>Cập nhật thông tin người dùng</title>
@endsection
@section('link')
    <link href="{{ asset('assets\apps\assets\apps\assets\libs\select2\css\select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Cập nhật thông tin người dùng</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Người dùng</a></li>
                            <li class="breadcrumb-item active">Cập nhật thông tin người dùng</li>
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
                            <form method="post" action="/users/{{ $user->id }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="formrow-firstname-input">Tên người dùng</label>
                                    <input type="text" name="name" value="{{ $user->name }}"
                                           required autofocus
                                           placeholder="{{ __('Tên người dùng') }}"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="formrow-firstname-input">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="formrow-email-input">Email</label>
                                    <input type="email" name="email" placeholder="{{ __('Địa chỉ EMail') }}"
                                           value="{{ $user->email }}"
                                           class="form-control @error('email') is-invalid @enderror"
                                           id="formrow-email-input">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Vai trò</label>
                                    <select name="menuroles" class="form-control select2-search-disable select2-init">
                                        @foreach(config('my-config.role-name') as $role => $name)
                                            <option
                                                {{ $user->menuroles == $role ? 'selected' : ''}}
                                                value="{{ $role }}">{{  $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-flex justify-content-around">
                                    <button type="submit" class="btn btn-primary w-md col-md-5">Cập nhật thông tin</button>
                                    <a href="{{ route('users.index') }}" class="btn btn-danger w-md col-md-5">Hủy</a>
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
    <script src="{{ asset('assets\apps\assets\apps\assets\libs\select2\js\select2.min.js') }}"></script>
    <script>
        $('.select2_init').select2({
            'placeholder' : 'Chọn vai trò'
        })
    </script>
    <!-- form advanced init -->
    <script src="{{ asset('assets\apps\assets\apps\assets\js\pages\form-advanced.init.js') }}"></script>
@endsection
