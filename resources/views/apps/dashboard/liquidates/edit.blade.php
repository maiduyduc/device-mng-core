@extends('apps.layouts.app')

@section('title')
    <title>Lập thanh lý</title>
@endsection
@section('link')
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Lập thanh lý</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Thanh lý</a></li>
                            <li class="breadcrumb-item active">Lập thanh lý</li>
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
                            <form method="post" action="{{ route('liquidate.update', ['id' => $liquidate->id]) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="formrow-input_document_name">Tên văn bản (<span class="text-danger">*</span>)</label>
                                            <input type="text" name="document_name"
                                                   class="form-control @error('document_name') is-invalid @enderror"
                                                   required autofocus
                                                   value="{{ $liquidate->name }}"
                                                   id="formrow-input_document_name">
                                            @error('document_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="formrow-inputInfo1">Mô tả</label>
                                            <textarea name="note" rows="5" id="formrow-inputInfo1"
                                                      autofocus
                                                      class="form-control">{{ $liquidate->note }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-wrapper" id="list-item">
                                    @foreach($liquidate->LiquidateInfo as $item)
                                        <div id="lec{{ $item->id }}" class="list-group-item rounded px-3 mb-1">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">
                                                    <a href="#!" class="text-dark" data-toggle="collapse"
                                                       data-target="#collapselist{{ $item->id }}">
                                                        <i class="fe fe-menu mr-1 text-muted align-middle"></i>
                                                        <span class="align-middle">Item {{ $i }}</span>
                                                        <p style="display: none"> {{ $i++ }}</p>
                                                    </a>
                                                </h5>
                                                <div>
                                                    <a href="#!" class="text-dark" aria-expanded="true"
                                                       data-toggle="collapse"
                                                       data-target="#collapselist{{ $item->id }}" aria-controls="collapselist{{ $item->id }}">
                                            <span class="chevron-arrow">
                                                <i class="bx bx-down-arrow"></i>
                                            </span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div id="collapselist{{ $item->id }}" class="collapse show" data-parent="#list-item">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label for="formrow-inputDeviceName">Tên thiết bị</label>
                                                                <input type="text" name="device_name[]" class="form-control"
                                                                       readonly value="{{ $item->device_name }}"
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
                                                                <label class="control-label">Giá thanh lý (<span class="text-danger">*</span>)</label>
                                                                <input type="number" class="form-control" name="price[]"
                                                                       value="{{ $item->price }}"
                                                                       required
                                                                       min="1" id="price">
                                                                @error('qty')
                                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="formrow-inputReason">Lý do</label>
                                                                <input type="text" name="reason[]" class="form-control"
                                                                       value="{{ $item->reason }}"
                                                                       id="formrow-inputReason">
                                                                @error('reason')
                                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="formrow-inputInfo">Thông tin thiết bị</label>
                                                                <textarea readonly name="device_info[]" rows="5" id="formrow-inputInfo"
                                                                          class="form-control">{{ $item->device_info }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="full_number[]" hidden value="{{ $item->full_number }}">
                                                    <input type="text" name="room_id[]" hidden value="{{ $item->room_id }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
                                            <a href="{{ route('liquidate.index') }}" style="width: 100%"
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
