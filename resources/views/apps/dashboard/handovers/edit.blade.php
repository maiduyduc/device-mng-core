@extends('apps.layouts.app')

@section('title')
    <title>Chỉnh sửa thông tin bàn giao</title>
@endsection
@section('link')
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Chỉnh sửa thông tin bàn giao</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Bàn giao</a></li>
                            <li class="breadcrumb-item active">Chỉnh sửa thông tin bàn giao</li>
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
                            <form method="post" action="{{ route('handover.update', ['id'=> $data->id]) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formrow-input_document_name">Tên văn bản (<span class="text-danger">*</span>)</label>
                                            <input type="text" name="document_name"
                                                   class="form-control @error('document_name') is-invalid @enderror"
                                                   required autofocus
                                                   value="{{ $data->name }}"
                                                   id="formrow-input_document_name">
                                            @error('document_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="item-wrapper" id="list-item">
                                    @foreach($data->HandoverInfo as $info)
                                        <div id="lec{{$info->id}}" class="list-group-item rounded px-3 mb-1">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">
                                                    <a href="#!" class="text-dark" data-toggle="collapse"
                                                       data-target="#collapselist{{$info->id}}">
                                                        <i class="fe fe-menu mr-1 text-muted align-middle"></i>
                                                        <span class="align-middle">Item {{ $i }}</span>
                                                        <p style="display: none;">{{ $i++ }}</p>
                                                    </a>
                                                </h5>
                                                <div>
                                                    <a href="#!" class="text-dark" aria-expanded="true"
                                                       data-toggle="collapse" data-target="#collapselist{{$info->id}}"
                                                       aria-controls="collapselist{{$info->id}}">
                                                    <span class="chevron-arrow">
                                                        <i class="bx bx-down-arrow"></i>
                                                    </span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div id="collapselist{{$info->id}}" class="collapse show"
                                                 data-parent="#list-item">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label for="formrow-inputDeviceName">Tên thiết bị (<span class="text-danger">*</span>)</label>
                                                                <input type="text" name="device_name[]"
                                                                       class="form-control"
                                                                       required
                                                                       value="{{ $info->device_name }}"
                                                                       id="formrow-inputDeviceName">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label for="formrow-inputOrigin">Xuất xứ</label>
                                                                <input type="text" class="form-control" name="origin[]"
                                                                       value="{{ $info->origin }}"
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
                                                                        <option @if($info->category_id == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
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
                                                                        <option @if($info->device_prefix_id == $prefix->id) selected @endif value="{{ $prefix->id }}">{{ $prefix->prefix }} - {{$prefix->display_name }}</option>
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
                                                                <label for="formrow-order_qty">Số lượng (<span class="text-danger">*</span>)</label>
                                                                <input type="number" name="qty[]" min="0"
                                                                       class="form-control"
                                                                       required value="{{ $info->qty }}"
                                                                       id="formrow-order_qty">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label for="formrow-serial">Mã serial</label>
                                                                <input type="text" name="serial[]"
                                                                       value="{{ $info->serial }}"
                                                                       class="form-control"
                                                                       id="formrow-serial">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label for="purchase_date">Ngày mua</label>
                                                                <input class="form-control" name="purchase_date[]" type="date" value="{{ $info->purchase_date }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="unit_price">Số lượng theo kiểm kê</label>
                                                                <input type="number" name="inventory_qty[]"
                                                                       min="0"
                                                                       value="{{ $info->inventory_qty }}"
                                                                       class="form-control"
                                                                       id="unit_price">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-12">
                                                            <label for="device_info">Thông tin chi tiết thiết bị</label>
                                                            <textarea rows="5" name="device_info[]" id="device_info"
                                                                      class="form-control">{{ $info->device_info }}</textarea>
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
                                            <a href="#!" class="btn btn-outline-info w-md" style="width: 100%"
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
    <script src="{{ asset('assets\apps\assets\js\add-item-document.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\libs\bs-custom-file-input\bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('assets\apps\assets\js\pages\form-element.init.js') }}"></script>
@endsection
