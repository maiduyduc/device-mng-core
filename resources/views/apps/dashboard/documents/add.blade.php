@extends('layouts.app')

@section('title')
    <title>Tạo chứng từ mua sắm</title>
@endsection
@section('link')
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Tạo chứng từ mua sắm</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Cấp phát</a></li>
                            <li class="breadcrumb-item active">Tạo chứng từ mua sắm</li>
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
                            <form method="post" action="{{ route('document.store') }}">
                                @csrf
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
                                                            <label for="formrow-inputOrigin">Xuất xứ</label>
                                                            <input type="text" class="form-control" name="origin[]"
                                                                   id="formrow-inputOrigin">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <label class="control-label">Loại thiết bị</label>
                                                            <select name="category_id[]"
                                                                    class="form-control">
                                                                <option selected value="">Chọn loại thiết bị
                                                                </option>
                                                                @foreach($categories as $category)
                                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <label class="control-label">Mã thiết bị</label>
                                                            <select name="device_prefix_id[]"
                                                                    class="form-control">
                                                                <option selected value="1">Chọn mã thiết bị
                                                                </option>
                                                                @foreach($device_prefix as $prefix)
                                                                    <option value="{{ $prefix->id }}">{{ $prefix->prefix }} - {{$prefix->display_name }}</option>
                                                                @endforeach
                                                            </select>
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
                                                            <label for="formrow-order_qty">Số lượng yêu
                                                                cầu</label>
                                                            <input type="number" name="order_qty[]" min="0"
                                                                   class="form-control @error('order_qty.0') is-invalid @enderror"
                                                                   required value="{{ old('order_qty.0') }}"
                                                                   id="formrow-order_qty">
                                                            @error('order_qty.0')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <label for="formrow-inputstock">Số lượng trong kho</label>
                                                            <input type="number" name="stock[]" min="0"
                                                                   required
                                                                   class="form-control @error('stock.0') is-invalid @enderror"
                                                                   id="formrow-inputstock">
                                                            @error('stock.0')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <label for="recommended_qty">Số lượng đề nghị
                                                                cấp</label>
                                                            <input type="number" name="recommended_qty[]"
                                                                   required min="0"
                                                                   class="form-control @error('recommended_qty.0') is-invalid @enderror"
                                                                   id="recommended_qty">
                                                            @error('recommended_qty.0')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="unit_price">Đơn giá (đã bao gồm VAT)</label>
                                                            <input type="number" name="unit_price[]"
                                                                   required min="0"
                                                                   class="form-control @error('unit_price.0') is-invalid @enderror"
                                                                   id="unit_price">
                                                            @error('unit_price.0')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="total_money">Tổng tiền (đã bao gồm VAT)</label>
                                                            <input type="number" name="total_money[]" id="total_money"
                                                                   required min="0"
                                                                   class="form-control @error('total_money.0') is-invalid @enderror">
                                                            @error('total_money.0')
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
                                                        <textarea rows="5" name="device_info[]" id="device_info"
                                                                  class="form-control @error('device_info.0') is-invalid @enderror"></textarea>
                                                        @error('device_info.0')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                        @enderror
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
                                            <a href="{{ route('document.index') }}" style="width: 100%"
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
    <script src="{{ asset('assets\js\add-item-document.js') }}"></script>
@endsection