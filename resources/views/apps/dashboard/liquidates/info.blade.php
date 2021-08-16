@extends('apps.layouts.app')

@section('title')
    <title>Thông tin thanh lý</title>
@endsection
@section('link')
    <link href="{{ asset('assets\apps\assets\libs\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css') }}"
          rel="stylesheet" type="text/css">
    <style>
        input[type="checkbox"][readonly] {
            cursor: not-allowed;
            opacity: 0.5;
        }

        .text-over {
            display: inline-block;
            width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        th, td {
            vertical-align: middle !important;
            text-align: center !important;
        }

        @media print {
            .noPrint {
                display: none;
            }

            .btn .btn-danger {
                display: none;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Thông tin thanh lý</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Thanh lý</a></li>
                            <li class="breadcrumb-item active">Thông tin thanh lý</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
            <div class="row" id="">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-5">
                                <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <h5>TRƯỜNG CAO ĐẲNG NGHỀ BÁCH KHOA HÀ NỘI</h5>
                                            <h5>Đơn vị: Phòng thiết vị và quản trị</h5>
                                        </div>
                                        <div class="" style="text-align: center">
                                            <h5>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</h5>
                                            <h5>Độc lập - Tự Do - Hạnh Phúc</h5>
                                            <p></p>
                                            <h6 style="text-align: right">Hà Nội,
                                                ngày {{ date_format($code[0]->created_at,"d") }}
                                                tháng {{ date_format($code[0]->created_at,"m") }}
                                                năm {{ date_format($code[0]->created_at,"Y") }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="d-flex justify-content-center mb-2">GIẤY ĐỀ NGHỊ THANH LÝ THIẾT BỊ</h3>
                                    <h5>Tên đơn vị xin thanh lý: Khoa CNTT</h5>
                                    <h5>Mô tả: {{ $code[0]->note }}</h5>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>TT</th>
                                        <th>Mã thiết bị</th>
                                        <th style="width: 200px">Tên thiết bị</th>
                                        <th>Thông tin thiết bị</th>
                                        <th style="width: 100px">Lý do</th>
                                        <th>Giá thanh lý</th>
                                    </tr>
                                    <tr>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>5</th>
                                        <th>6</th>
                                    </tr>
                                    </thead>
                                    <form>
                                        <tbody>
                                        @foreach($devicesList as $info)
                                            <tr>
                                                <th>{{ $i }}</th>
                                                <td>
                                                    {{ $info->full_number }}
                                                </td>

                                                <td>
                                                    {{ $info->device_name }}
                                                </td>
                                                <td>
                                                    {{ $info->device_info }}
                                                </td>
                                                <td>
                                                    {{ $info->reason }}
                                                </td>
                                                <td>
                                                    {{ number_format($info->price)  }}
                                                </td>
                                            </tr>
                                            <p style="display: none">{{$i++}}</p>
                                        @endforeach
                                        </tbody>
                                    </form>
                                </table>
                            </div>
                            <p></p>
                            <div class="d-flex justify-content-around">
                                <h5>Hiệu trưởng</h5>
                                <h5>Phòng Thiết bị & quản trị</h5>
                                <h5>Trưởng đơn vị</h5>
                                <h5>Người đề nghị</h5>
                            </div>
                            <div>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
            <div>
                <p></p>
                <div class="row">
                    @if($code[0]->status == 'accept' || $code[0]->status == 'liquidated')
                        <div class="col-md-6 noPrint">
                            <form method="post"
                                  action="{{ route('liquidate.liquidated', ['id'=>$code[0]->id]) }}">
                                @csrf
                                <button class="btn btn-primary badge badge-primary font-size-14 noPrint"
                                        style="width: 100%; height: 36px"
                                        @if($code[0]->status == 'liquidated')
                                        disabled
                                        @endif
                                        type="submit">
                                    @if($code[0]->status == 'liquidated')
                                        Đã thanh lý
                                    @else
                                        Thanh lý
                                    @endif
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="col-md-3 noPrint">
                            <form method="post"
                                  action="{{ route('liquidate.approve', ['id'=>$code[0]->id]) }}">
                                @csrf
                                <button class="btn btn-primary badge badge-primary font-size-14 noPrint"
                                        style="width: 100%; height: 36px"
                                        @if($code[0]->can_edit == 0)
                                        disabled
                                        @endif
                                        type="submit">
                                    @if($code[0]->status == 'accept')
                                        Đã phê duyệt
                                    @else
                                        Phê duyệt
                                    @endif
                                </button>
                            </form>
                        </div>
                        <div class="col-md-3 noPrint">
                            <form method="post"
                                  action="{{ route('liquidate.refuse', ['id'=>$code[0]->id]) }}">
                                @csrf
                                <button class="btn btn-danger badge badge-danger font-size-14 noPrint"
                                        style="width: 100%; height: 36px"
                                        @if($code[0]->can_edit == 0)
                                        disabled
                                        @endif
                                        type="submit">
                                    @if($code[0]->status == 'cancel')
                                        Đã từ chối
                                    @else
                                        Từ chối
                                    @endif
                                </button>
                            </form>
                        </div>
                    @endif
                    <div class="col-md-3 noPrint">
                        <button type="button" style="width: 100%; height: 36px" onclick="window.print()"
                                class="btn btn-info badge badge-info font-size-14">
                            In văn bản
                        </button>
                    </div>
                    <div class="col-md-3 noPrint">
                        <a style="width: 100%; height: 36px; line-height: 20px;" href="{{ route('liquidate.index') }}"
                           class="btn btn-outline-dark font-size-14 noPrint"><i class="bx bx-arrow-back"></i></a>
                    </div>
                </div>

            </div>
    </div>
@endsection

@section('js')

@endsection
