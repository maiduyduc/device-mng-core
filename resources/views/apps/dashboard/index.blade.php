@extends('apps.layouts.app')

@section('title')
    <title>Trang chủ</title>
@endsection
@section('link')
    <link href="{{ asset('assets\apps\assets\libs\datatables.net-bs4\css\dataTables.bootstrap4.min.css') }}"
          rel="stylesheet"
          type="text/css">
    <link href="{{ asset('assets\apps\assets\libs\datatables.net-buttons-bs4\css\buttons.bootstrap4.min.css') }}"
          rel="stylesheet"
          type="text/css">
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Trang chủ</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Trang chủ</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card border border-primary">
                    <div class="card-header bg-transparent border-primary">
                        <h4 class="my-0 text-primary"><i class="mdi mdi-clipboard-text-outline mr-3"></i>Văn bản</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">

                                <thead class="thead-light">
                                <tr>
                                    <th><h5>Loại văn bản</h5></th>
                                    <th><h5>Đã phê duyệt</h5></th>
                                    <th><h5>Đã phê duyệt <br> nhưng chưa sử dụng</h5></th>
                                    <th><h5>Chưa phê duyệt</h5></th>
                                    <th><h5>Đã từ chối</h5></th>
                                    <th><h5>Tổng</h5></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($document_systems as $item)
                                    <tr>
                                        <th scope="row"><h5>{{ $item->DocumentPrefix->display_name }}</h5></th>
                                        <td><h4>{{ $item->approved }}</h4></td>
                                        <td><h4>{{ $item->approved_but_not_use }}</h4></td>
                                        <td><h4>{{ $item->pending }}</h4></td>
                                        <td><h4>{{ $item->refuse }}</h4></td>
                                        <td><h4>{{ $item->total }}</h4></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card border border-primary" style="background-color: #f9faff">
                    <div class="card-header bg-transparent border-primary">
                        <h5 class="my-0 text-primary"><i class="mdi mdi-devices mr-3"></i>Thiết bị</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="text-muted font-weight-medium">
                                                    <a href="{{ route('device.index') }}">Số lượng thiết bị đang sử dụng</a>
                                                </p>
                                                <h4 class="mb-0">{{ $devices }}</h4>
                                            </div>

                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                        <span class="avatar-title">
                                            <i class="mdi mdi-desktop-tower-monitor font-size-24"></i>
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="text-muted font-weight-medium">
                                                    <a href="{{ route('device.index', 'noRoom') }}">Số lượng tồn kho</a>
                                                </p>
                                                <h4 class="mb-0">{{ $stocks }}</h4>
                                            </div>

                                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-archive-in font-size-24"></i>
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="text-muted font-weight-medium">
                                                    <a href="{{ route('device.index','error') }}">Số máy đang hỏng</a>
                                                </p>
                                                <h4 class="mb-0">{{ $device_error }}</h4>
                                            </div>

                                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="mdi mdi-block-helper font-size-24"></i>
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
