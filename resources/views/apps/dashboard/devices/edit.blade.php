@extends('apps.layouts.app')

@section('title')
    <title>Sửa thông tin thiết bị</title>
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
                    <h4 class="mb-0 font-size-18">Sửa thông tin thiết bị</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Thiết bị</a></li>
                            <li class="breadcrumb-item active">Sửa thông tin thiết bị</li>
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
                            <form method="post" action="{{ route('device.update', ['id' => $device->id]) }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="formrow-inputCode">Mã thiết bị</label>
                                                <input type="text"
                                                       class="form-control"
                                                       readonly disabled
                                                       value="{{ $device->full_number }}"
                                                       id="formrow-inputCode">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="formrow-seri">Số Seri</label>
                                                <input type="text" name="serial"
                                                       value="{{ $device->serial }}"
                                                       class="form-control @error('serial') is-invalid @enderror"
                                                       id="formrow-seri">
                                                @error('serial')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="control-label">Phòng</label>
                                                <select name="room_id"
                                                        class="form-control select2-search-disable select2-init">
                                                    <option selected value="">Chọn phòng
                                                    </option>
                                                    @foreach($rooms as $room)
                                                        <option value="{{ $room->id }}"
                                                                @if($room->id == $device->room_id) selected @endif>{{ $room->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="control-label">Nhóm thiết bị</label>
                                                <select name="group_id"
                                                        class="form-control select2-search-disable select2-init">
                                                    <option selected value="">Chọn nhóm thiết bị
                                                    </option>
                                                    @foreach($device_groups as $group)
                                                        <option value="{{ $group->id }}"
                                                                @if($group->id == $device->device_group_id) selected @endif>{{ $group->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="formrow-name">Tên thiết bị</label>
                                                <input type="text" name="device_name" min="0"
                                                       class="form-control @error('device_name') is-invalid @enderror"
                                                       required value="{{ $device->device_name }}"
                                                       id="formrow-name">
                                                @error('device_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12">
                                            <label for="device_info">Thông tin chi tiết thiết bị</label>
                                            <textarea rows="5" name="device_info" id="device_info"
                                                      class="form-control @error('device_info') is-invalid @enderror">{{ $device->device_info }}</textarea>
                                            @error('device_info')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <p></p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="submit" style="width: 100%" class="btn btn-primary w-md">Hoàn
                                                thành
                                            </button>
                                        </div>
                                        <div class="col-md-6">
{{--                                            <a href="{{ route('device.index') }}" style="width: 100%"--}}
{{--                                               class="btn btn-danger w-md">Hủy</a>--}}
                                            <input
                                                onclick="window.history.go(-1); return false;"
                                                type="submit"
                                                style="width: 100%"
                                                class="btn btn-danger w-md"
                                                value="Hủy"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </form>
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
            'placeholder' : 'Chọn vai trò'
        })
    </script>
    <!-- form advanced init -->
    <script src="{{ asset('assets\apps\assets\js\pages\form-advanced.init.js') }}"></script>
@endsection
