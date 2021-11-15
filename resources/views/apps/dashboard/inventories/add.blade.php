@extends('apps.layouts.app')

@section('title')
    <title>Tạo văn bản kiểm kê</title>
@endsection
@section('link')
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Tạo văn bản kiểm kê</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kiểm kê</a></li>
                            <li class="breadcrumb-item active">Tạo văn bản kiểm kê</li>
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
                            <form method="post" action="{{ route('inventory.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formrow-inputInfo11">Kỳ kiểm kê</label>
                                            <input type="text" name="semesters"
                                                   class="form-control @error('semesters') is-invalid @enderror"
                                                   required autofocus
                                                   value="{{ old('semesters') }}"
                                                   id="formrow-inputInfo11">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formrow-inputInfo1">Ghi chú</label>
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
                                                   data-toggle="collapse" data-target="#collapselist1"
                                                   aria-controls="collapselist1">
                                                    <span class="chevron-arrow">
                                                        <i class="bx bx-down-arrow"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        <div id="collapselist1" class="collapse show"
                                             data-parent="#list-item">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="formrow-inputDeviceName">Tên thiết bị</label>
                                                            <input type="text" name="device_name[]"
                                                                   class="form-control @error('device_name.0') is-invalid @enderror"
                                                                   required
                                                                   value="{{ old('device_name.0') }}"
                                                                   id="formrow-inputDeviceName">
                                                            @error('device_name.0')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="DeviceCode">Mã thiết bị</label>
                                                            <input type="text" class="form-control" name="device_code[]"
                                                                   id="DeviceCode">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <label for="serial" class="control-label">Mã Serial</label>
                                                            <input type="text" class="form-control" name="serial[]"
                                                                   id="serial">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <label for="dateP" class="control-label">Ngày mua</label>
                                                            <input type="date" class="form-control" name="date_purchase[]"
                                                                   id="dateP">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <label class="control-label">Đơn vị tính</label>
                                                            <select name="unit[]"
                                                                    class="form-control">
                                                                <option selected value=" ">Chọn đơn vị tính
                                                                </option>
                                                                <option value="Bộ">Bộ</option>
                                                                <option value="Chiếc">Chiếc</option>
                                                                <option value="Cái">Cái</option>
                                                                <option value="Thùng">Thùng</option>
                                                                <option value="Hộp">Hộp</option>
                                                                <option value="Ram">Ram</option>
                                                                <option value="Cuộn">Cuộn</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <label for="qty_doc">Số lượng theo sổ sách</label>
                                                            <input type="number" name="qty_document[]" min="0"
                                                                   class="form-control @error('qty_document.0') is-invalid @enderror"
                                                                   required value="{{ old('qty_document.0') }}"
                                                                   id="qty_doc">
                                                            @error('qty_document.0')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <label for="price_document">Nguyên giá</label>
                                                            <input type="number" name="price_document[]" min="0"
                                                                   required
                                                                   class="form-control @error('price_document.0') is-invalid @enderror"
                                                                   id="price_document">
                                                            @error('price_document.0')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <label for="qty_inventory">Số lượng theo kiểm kê</label>
                                                            <input type="number" name="qty_inventory[]"
                                                                   required min="0"
                                                                   class="form-control @error('qty_inventory.0') is-invalid @enderror"
                                                                   id="qty_inventory">
                                                            @error('qty_inventory.0')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <label for="price_inventory">Nguyên giá (theo kiểm kê)</label>
                                                            <input type="number" name="price_inventory[]"
                                                                   required min="0"
                                                                   class="form-control @error('price_inventory.0') is-invalid @enderror"
                                                                   id="price_inventory">
                                                            @error('price_inventory.0')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <label for="funds">Nguồn tiền</label>
                                                            <input type="text" name="funds[]" id="funds"
                                                                   class="form-control @error('funds.0') is-invalid @enderror">
                                                            @error('funds.0')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <label for="estimate_price">Giá trị ước tính</label>
                                                            <input type="number" name="estimate_price[]" id="estimate_price"
                                                                   required min="0"
                                                                   class="form-control @error('estimate_price.0') is-invalid @enderror">
                                                            @error('estimate_price.0')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
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
                                            <a href="#add" id="add" class="btn btn-outline-info w-md"
                                               style="width: 100%"
                                               onclick="appendText()">Thêm thiết bị</a>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" style="width: 100%" class="btn btn-primary w-md">Hoàn
                                                thành
                                            </button>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ route('inventory.index') }}" style="width: 100%"
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
    <script src="{{ asset('assets\apps\assets\js\add-item-inventory.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\libs\bs-custom-file-input\bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\js\pages\form-element.init.js') }}"></script>
@endsection
