@extends('apps.layouts.app')

@section('title')
    <title>Cập nhật thông tin menu</title>
@endsection
@section('link')
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Cập nhật thông tin menu</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý menu chính</a></li>
                            <li class="breadcrumb-item active">Cập nhật thông tin menu</li>
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
                            <form method="post" action="{{ route('menu.menu.update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $menulist->id }}" id="menuElementId"/>
                                <div class="form-group">
                                    <label for="formrow-firstname-input">Tên menu</label>
                                    <input type="text" name="name" value="{{ $menulist->name }}"
                                           required autofocus
                                           placeholder="{{ __('Tên menu') }}"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="formrow-firstname-input">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-around">
                                    <button type="submit" class="btn btn-primary w-md col-md-5">Cập nhật thông tin</button>
                                    <a href="{{ route('menu.menu.index') }}" class="btn btn-danger w-md col-md-5">Hủy</a>
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

@endsection
