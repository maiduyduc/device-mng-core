@extends('apps.layouts.app')

@section('title')
    <title>Xuất thông tin thiết bị</title>
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
                    <h4 class="mb-0 font-size-18">Xuất thông tin thiết bị</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Bàn giao</a></li>
                            <li class="breadcrumb-item active">Xuất thông tin thiết bị</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="checkout-tabs">
            <div class="row">
                <div class="col-lg-2">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-gen-ques-tab" data-toggle="pill" href="#one-room"
                           role="tab" aria-controls="v-pills-gen-ques" aria-selected="true">
                            <i class="mdi mdi-home-floor-1 d-block check-nav-icon mt-4 mb-2"></i>
                            <p class="font-weight-bold mb-4">Xuất thông tin vào 1 phòng</p>
                        </a>
                        <a class="nav-link" id="v-pills-privacy-tab" data-toggle="pill" href="#many-room" role="tab"
                           aria-controls="v-pills-privacy" aria-selected="false">
                            <i class="mdi mdi-home-plus d-block check-nav-icon mt-4 mb-2"></i>
                            <p class="font-weight-bold mb-4">Xuất thông tin vào nhiều phòng</p>
                        </a>

                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="one-room" role="tabpanel"
                                     aria-labelledby="v-pills-gen-ques-tab">
                                    <h4 class="card-title mb-4">Chọn phòng để xuất thông tin</h4>
                                    <form method="post" action="{{ route('handover.exportOneRoom', ['id' => $handover_id->id]) }}">
                                        @csrf
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table class="table mb-3">

                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tên thiết bị</th>
                                                        <th>Số lượng</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($device_infos as $device)
                                                        <tr>
                                                            <th scope="row">
                                                                {{ $i }}
                                                                <p style="display: none">{{ $i++ }}</p>
                                                            </th>
                                                            <td>{{ $device->device_name }}</td>
                                                            <td>{{ $device->qty }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <select name="room_id"
                                                            style="cursor: pointer"
                                                            class="form-control select2-search-disable">
                                                        <option selected hidden value="">Chọn phòng
                                                        </option>
                                                        @foreach($rooms as $room)
                                                            <option value="{{ $room->id }}.{{$room->name}}">{{ $room->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-md-6">
                                                    <button type="submit" style="width: 100%"
                                                            class="btn btn-primary w-md">Đồng ý
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="" style="width: 100%"
                                                   class="btn btn-danger w-md">Hủy</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="many-room" role="tabpanel"
                                     aria-labelledby="v-pills-privacy-tab">
                                    <h4 class="card-title mb-4">Vui lòng chọn phòng cho tất cả thiết bị</h4>
                                    <form method="post" action="{{ route('handover.exportManyRoom', ['id' => $handover_id->id]) }}">
                                        @csrf
                                        <div>
                                            <div class="chat-conversation p-3">
                                                <ul class="list-unstyled" data-simplebar="" style="max-height: 350px;">
                                                    <li>
                                                        <div class="p-3 chat-input-section">
                                                            @foreach($device_infos as $device)
                                                                @for($i = 0; $i < $device->qty; $i++)
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <input type="hidden" name="device_id[]"
                                                                                   value="{{$device->id}}">
                                                                            <input type="text" name="device_name[]"
                                                                                   class="form-control"
                                                                                   value="{{ $device->device_name }}"
                                                                                   style="cursor: not-allowed"
                                                                                   readonly="readonly">
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <select name="room_id[]"
                                                                                        style="cursor: pointer"
                                                                                        class="form-control select2-search-disable">
                                                                                    <option selected hidden value="">
                                                                                        Chọn phòng
                                                                                    </option>
                                                                                    @foreach($rooms as $room)
                                                                                        <option
                                                                                            value="{{ $room->id }}.{{$room->name}}">{{ $room->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endfor
                                                            @endforeach
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="submit" style="width: 100%"
                                                        class="btn btn-primary w-md">Đồng ý
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="" style="width: 100%"
                                                   class="btn btn-danger w-md">Hủy</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

    </div>
@endsection

@section('js')
    <script src="{{ asset('assets\apps\assets\libs\select2\js\select2.min.js') }}"></script>
@endsection
