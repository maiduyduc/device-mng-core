@extends('apps.layouts.app')

@section('title')
    <title>Lập dự trù</title>
@endsection
@section('link')
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Lập dự trù</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Cấp phát</a></li>
                            <li class="breadcrumb-item active">Lập dự trù</li>
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
                            <form method="post" action="{{ route('device-plan.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formrow-document-name">
                                                Tên văn bản (<span class="text-danger">*</span>)
                                            </label>
                                            <input type="text" name="document_name" class="form-control"
                                                   required autofocus
                                                   id="formrow-document-name">
                                            @error('document_name')
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="formrow-inputInfo1">Mô tả</label>
                                            <textarea name="detail" rows="5" id="formrow-inputInfo1"
                                                      class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-wrapper" id="list-item">
                                    <div id="lec1" class="list-group-item rounded px-3 mb-1">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h5 class="mb-0">
                                                <a href="#!" class="text-dark" data-toggle="collapse"
                                                   data-target="#collapselist1">
                                                    <i class="fe fe-menu mr-1 text-muted align-middle"></i>
                                                    <span class="align-middle">Item 1</span>
                                                </a>
                                            </h5>
                                            <div>
                                                <a href="#!" class="text-dark" aria-expanded="true"
                                                   data-toggle="collapse"
                                                   data-target="#collapselist1" aria-controls="collapselist1">
                                            <span class="chevron-arrow">
                                                <i class="bx bx-down-arrow"></i>
                                            </span>
                                                </a>
                                            </div>
                                        </div>
                                        <div id="collapselist1" class="collapse show" data-parent="#list-item">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="formrow-inputDeviceName">Tên thiết bị (<span class="text-danger">*</span>)</label>
                                                            <input type="text" name="device_name[]" class="form-control"
                                                                   required
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
                                                            <label for="qty">Số lượng (<span class="text-danger">*</span>)</label>
                                                            <input type="number" class="form-control" name="qty[]"
                                                                   required
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
                                                                <option selected value="">Chọn loại thiết bị
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
                                                            <label for="formrow-inputInfo">Thông tin thiết bị</label>
                                                            <textarea name="device_info[]" rows="5" id="formrow-inputInfo"
                                                                      class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="formrow-inputNote">Ghi chú</label>
                                                            <input type="text" class="form-control" name="note[]"
                                                                   id="formrow-inputNote">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <p></p>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="#add" style="width: 100%"
                                               id="add"
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
        <script src="{{ asset('assets\apps\assets\js\add-item-device-plan.js') }}"></script>
@endsection
