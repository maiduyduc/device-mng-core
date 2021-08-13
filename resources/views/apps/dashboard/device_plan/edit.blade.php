@extends('layouts.app')

@section('title')
    <title>Sửa thông tin dự trù</title>
@endsection
@section('link')
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Sửa thông tin dự trù</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Cấp phát</a></li>
                            <li class="breadcrumb-item active">Sửa thông tin dự trù</li>
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
                            <form method="post"
                                  action="{{ route('device-plan.update', ['id' => $device_plan_id->id]) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formrow-inputInfo1">Mô tả</label>
                                            <textarea name="detail" rows="5" id="formrow-inputInfo1"
                                                      class="form-control">{{ $device_plan_id->note }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-wrapper" id="list-item">
                                    @foreach($device_plan_id->DevicePlanInfo as $info)
                                        <div id="lec{{ $info->id }}" class="list-group-item rounded px-3 mb-1">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">
                                                    <a href="#!" class="text-dark" data-toggle="collapse"
                                                       data-target="#collapselist{{ $info->id }}">
                                                        <i class="fe fe-menu mr-1 text-muted align-middle"></i>
                                                        <span class="align-middle">Item {{ $i }}</span>
                                                        <p style="display: none"> {{ $i++ }}</p>
                                                    </a>
                                                </h5>
                                                <div>
                                                    <a href="#!" class="mr-1 text-dark" data-toggle="tooltip"
                                                       data-placement="top" onClick="delLecture({{ $info->id }})"
                                                       data-original-title="Delete">
                                                        <i class="bx bx-trash"></i>
                                                    </a>
                                                    <a href="#!" class="text-dark" aria-expanded="true"
                                                       data-toggle="collapse"
                                                       data-target="#collapselist{{ $info->id }}"
                                                       aria-controls="collapselist{{ $info->id }}">
                                            <span class="chevron-arrow">
                                                <i class="bx bx-down-arrow"></i>
                                            </span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div id="collapselist{{ $info->id }}" class="collapse show"
                                                 data-parent="#list-item">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="formrow-inputDeviceName">Tên thiết
                                                                    bị</label>
                                                                <input type="text" name="device_name[]"
                                                                       class="form-control"
                                                                       required
                                                                       value="{{ $info->device_name }}"
                                                                       id="formrow-inputDeviceName">
                                                                @error('device_name')
                                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label for="qty">Số lượng</label>
                                                                <input type="number" class="form-control" name="qty[]"
                                                                       required
                                                                       value="{{ $info->qty }}"
                                                                       min="1" id="qty">
                                                                @error('qty')
                                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Loại thiết bị</label>
                                                                <select name="category_id[]"
                                                                        class="form-control">
                                                                    <option selected value=" ">Chọn loại thiết bị
                                                                    </option>
                                                                    <option value="1">Bàn ghế</option>
                                                                    <option value="2">Máy tính</option>
                                                                    <option value="3">Thiết bị mạng</option>
                                                                    <option value="4">Dụng cụ mỹ thuật</option>
                                                                    <option value="5">Thiết bị khác</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="formrow-inputInfo">Thông tin thiết
                                                                    bị</label>
                                                                <textarea name="device_info[]" rows="5"
                                                                          id="formrow-inputInfo"
                                                                          class="form-control">{{ $info->device_info }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="formrow-inputNote">Ghi chú</label>
                                                                <input type="text" class="form-control" name="note[]"
                                                                       value="{{ $info->note }}"
                                                                       id="formrow-inputNote">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div>
                                    <p></p>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="#" style="width: 100%"
                                               onclick="appendText()"
                                               class="btn btn-outline-info w-md">Thêm thiết bị</a>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" style="width: 100%" class="btn btn-primary w-md">Hoàn
                                                thành
                                            </button>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ route('device-plan.index') }}" style="width: 100%"
                                               class="btn btn-danger w-md">Hủy</a>
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
    <script src="{{ asset('assets\js\add-item-device-plan.js') }}"></script>
@endsection
