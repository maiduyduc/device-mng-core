@extends('apps.layouts.app')

@section('title')
    <title>Tạo nhóm thiết bị</title>
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
                    <h4 class="mb-0 font-size-18">Tạo nhóm thiết bị</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Thiết bị</a></li>
                            <li class="breadcrumb-item active">Tạo nhóm thiết bị</li>
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
                            <form method="post" action="{{ route('device-group.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="formrow-name-input">Tên nhóm (<span class="text-danger">*</span>)</label>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="formrow-name-input"
                                           placeholder="Nhập tên nhóm thiết bị"
                                           value="{{ old('name') }}"
                                           required="">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Phòng (<span class="text-danger">*</span>)</label>
                                    <select name="room_id" class="form-control select2-search-disable select2-init">
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Đồng ý</button>
                                    <a href="{{ route('device-group.index') }}" class="btn btn-danger w-md">Hủy</a>
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
    <script>
        $('.select2_init').select2({
            'placeholder' : 'Chọn phòng'
        })
    </script>
    <!-- form advanced init -->
    <script src="{{ asset('assets\apps\assets\js\pages\form-advanced.init.js') }}"></script>
@endsection
