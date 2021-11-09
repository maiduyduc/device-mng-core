@extends('apps.layouts.app')

@section('title')
    <title>Thông tin chứng từ</title>
@endsection
@section('link')
    <link href="{{ asset('assets\apps\assets\libs\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css') }}"
          rel="stylesheet" type="text/css">
    <style>
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

        .isDisabled {
            color: currentColor;
            cursor: not-allowed;
            opacity: 0.5;
            pointer-events: none;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Thông tin chứng từ</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Bàn giao</a></li>
                            <li class="breadcrumb-item active">Thông tin chứng từ</li>
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
                                    <div class="" style="text-align: center">
                                        <h5>BỘ LAO ĐỘNG TB & XH</h5>
                                        <h5>TRƯỜNG CAO ĐẲNG NGHỀ BK HN</h5>
                                        <h6><i>V/v: Bàn giao thiết bị cho tổ kỹ thuật</i></h6>
                                    </div>
                                    {{--                                    <div class="" style="text-align: center">--}}
                                    {{--                                        <h5>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</h5>--}}
                                    {{--                                        <h5>Độc lập - Tự Do - Hạnh Phúc</h5>--}}
                                    {{--                                        <p></p>--}}
                                    {{--                                        <h6 style="text-align: right">Hà Nội,--}}
                                    {{--                                            ngày {{ date_format($code[0]->created_at,"d") }}--}}
                                    {{--                                            tháng {{ date_format($code[0]->created_at,"m") }}--}}
                                    {{--                                            năm {{ date_format($code[0]->created_at,"Y") }}--}}
                                    {{--                                        </h6>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <h3 class="d-flex justify-content-center mb-2">BIÊN BẢN BÀN GIAO THIẾT BỊ KHOA CÔNG NGHỆ
                                    THÔNG TIN</h3>
                                {{--                                <h5>Tên đơn vị xin cấp: Khoa CNTT</h5>--}}
                                {{--                                <h5>Sử dụng vào việc gì:</h5>--}}
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th rowspan="2">TT</th>
                                    {{--                                    <th rowspan="2" style="width: 100px">Phòng</th>--}}
                                    <th rowspan="2" style="width: 200px">Tên tài sản</th>
                                    <th rowspan="2">Mã quản lý</th>
                                    <th rowspan="2">Số seri</th>
                                    <th rowspan="2">Ngày mua</th>
                                    <th rowspan="2">ĐVT</th>
                                    <th rowspan="1" colspan="1">Theo sổ sách</th>
                                    <th rowspan="1" colspan="3">Theo kiểm kê</th>
                                    <th rowspan="2" style="width: 100px">Ghi chú</th>
                                    <th rowspan="2" style="width: 100px">Người bàn giao</th>
                                    <th rowspan="2">Đại diện phòng kỹ thuật</th>
                                    <th rowspan="2">Đại diện khoa CNTT</th>
                                </tr>
                                <tr>
                                    <th>SL</th>
                                    <th>SL</th>
                                    <th>Đủ</th>
                                    <th>Thiếu</th>
                                </tr>
                                </thead>
                                <form>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                        <td>6</td>
                                        <td>7</td>
                                        <td>8</td>
                                        <td>9</td>
                                        <td>10</td>
                                        <td>11</td>
                                        <td>12</td>
                                        <td>13</td>
                                        <td>14</td>
                                        {{--                                        <td>15</td>--}}
                                    </tr>
                                    @foreach($infos as $info)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            {{--                                        <td>{{ $info->rooms->name }}</td>--}}
                                            <td>{{ $info->device_name }}</td>
                                            <td></td>
                                            <td>{{ $info->serial }}</td>
                                            <td>{{ $info->purchase_date }}</td>
                                            <td>{{ $info->unit }}</td>
                                            <td>{{ $info->qty }}</td>
                                            <td>{{ $info->inventory_qty }}</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $info->note }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <p style="display: none">{{ $i++ }}</p>
                                    @endforeach
                                    </tbody>

                                </form>
                            </table>
                        </div>
                        {{--                        <h5 class="d-flex justify-content-center m-3">(Bằng chữ:--}}
                        {{--                            ...........................................................................................................................)</h5>--}}
                        {{--                        <div class="d-flex justify-content-around">--}}
                        {{--                            <h5>Hiệu trưởng</h5>--}}
                        {{--                            <h5>Phòng Thiết bị & quản trị</h5>--}}
                        {{--                            <h5>Trưởng đơn vị</h5>--}}
                        {{--                            <h5>Người đề nghị</h5>--}}
                        {{--                        </div>--}}

                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
        <div>
            <p></p>
            <div class="row">
                @if(Auth::user()->menuroles == 'ptb')
                <div class="col-md-3 noPrint">
                    <a class="btn btn-outline-danger badge badge-soft-danger font-size-14 d-flex align-items-center justify-content-center @if($code[0]->is_handover == 1) isDisabled @endif"
                       style="width: 100%; height: 36px;"
                       href="{{ route('handover.edit', ['id'=>$code[0]->id]) }}"> Chỉnh sửa </a>
                </div>
                <div class="col-md-3 noPrint">
                    <form method="post"
                          action="{{ route('handover.approve', ['id' => $code[0]->id]) }}">
                        @csrf
                        <button class="btn btn-primary badge badge-primary font-size-14 noPrint"
                                style="width: 100%; height: 36px"
                                @if($code[0]->is_handover == 1) disabled @endif
                                type="submit">Bàn giao
                        </button>
                    </form>
                </div>
                @else
                    <div class="col-md-6 noPrint">
                        <button type="button" style="width: 100%; height: 36px"
                                class="btn btn-info badge badge-info font-size-14 isDisabled">
                            @if($code[0]->is_handover == 1)
                                Đã bàn giao
                            @else
                                Chờ bàn giao
                            @endif
                        </button>
                    </div>
                @endif
                <div class="@if(Auth::user()->menuroles == 'ktv') col-md-3 @else col-md-5 @endif noPrint">
                    <button type="button" style="width: 100%; height: 36px" onclick="window.print()"
                            class="btn btn-info badge badge-info font-size-14">
                        In văn bản
                    </button>
                </div>
                    @if(Auth::user()->menuroles == 'ktv')
                <div class="col-md-2 noPrint">
                    <a class="btn btn-danger badge badge-soft-danger font-size-14 d-flex align-items-center justify-content-center @if($code[0]->can_export == 0 || $code[0]->is_export == 1) disabled @endif"
                       style="width: 100%; height: 36px; "
                       href="{{ route('handover.export', ['id' => $code[0]->id]) }}"> Xuất thông tin </a>
                </div>
                    @endif
                <div class="col-md-1 noPrint">
                    <a class="btn btn-outline-dark font-size-14 noPrint"
                       href="{{ route('handover.index') }}"
                       style="width: 100%; height: 36px"
                       type="submit">
                        <i class="bx bx-arrow-back"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="messageBoard" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content message-modal">

            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
