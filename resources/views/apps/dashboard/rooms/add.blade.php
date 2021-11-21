@extends('apps.layouts.app')

@section('title')
    <title>Thêm phòng</title>
@endsection
@section('link')
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Thêm phòng</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Phòng</a></li>
                            <li class="breadcrumb-item active">Thêm phòng</li>
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
                            <form method="post" action="{{ route('room.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="formrow-name-input">Tên phòng (<span class="text-danger">*</span>)</label>
                                    <input type="text" name="name"
                                           class="form-control"
                                           id="formrow-name-input"
                                           placeholder="Nhập tên phòng"
                                           required>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Đồng ý</button>
                                    <a href="{{ route('room.index') }}" class="btn btn-danger w-md">Hủy</a>
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
