@extends('apps.layouts.app')

@section('title')
    <title>Thông tin chứng từ</title>
@endsection
@section('link')
    <link href="{{ asset('assets\apps\assets\libs\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css') }}"
          rel="stylesheet" type="text/css">
    <style>
        th, td {
            vertical-align: middle !important;
            text-align: center !important;
        }

        .text-over {
            display: inline-block;
            width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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
                    <h4 class="mb-0 font-size-18">Thông tin chứng từ</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Cấp phát</a></li>
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
                                <h3 class="d-flex justify-content-center mb-2">GIẤY ĐỀ NGHỊ THANH TOÁN MUA MỚI, SỬA CHỮA
                                    (THIẾT BỊ, DỤNG CỤ, VẬT TƯ,...)</h3>
                                <h5>Tên đơn vị xin cấp: Khoa CNTT</h5>
                                <h5>Sử dụng vào việc gì:</h5>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="text-align: center">TT</th>
                                    <th style="text-align: center; width: 200px">Tên hàng</th>
                                    <th style="text-align: center">Thông số kỹ <br> thuật chi tiết</th>
                                    <th style="text-align: center; width: 100px">Xuất xứ</th>
                                    <th style="text-align: center">Đơn vị <br> tính</th>
                                    <th style="text-align: center; width: 100px">Số lượng <br> theo yêu <br> cầu</th>
                                    <th style="text-align: center; width: 100px">Số lượng <br> còn <br> trong <br> kho
                                    </th>
                                    <th style="text-align: center; width: 100px">Số lượng <br> đề nghị <br> duyệt <br>
                                        cấp
                                    </th>
                                    <th style="text-align: center; width: 100px">Đơn giá đã <br> bao gồm thuế <br>
                                        (đồng)
                                    </th>
                                    <th style="text-align: center; width: 100px">Thành tiền đã <br> bao gồm thuế <br>
                                        (đồng)
                                    </th>
                                    <th style="text-align: center">Ghi chú</th>
                                </tr>
                                <tr>
                                    <th style="text-align: center">1</th>
                                    <th style="text-align: center">2</th>
                                    <th style="text-align: center">3</th>
                                    <th style="text-align: center">4</th>
                                    <th style="text-align: center">5</th>
                                    <th style="text-align: center">6</th>
                                    <th style="text-align: center">7</th>
                                    <th style="text-align: center">8</th>
                                    <th style="text-align: center">9</th>
                                    <th style="text-align: center">10</th>
                                    <th style="text-align: center">11</th>
                                </tr>
                                </thead>
                                <form>
                                    <tbody>
                                    @foreach($infos as $info)
                                        <tr>
                                            <th style="text-align: center">{{ $i }}</th>
                                            <td>
                                                {{ $info->device_name }}
                                            </td>

                                            <td>
                                                {{ $info->device_info }}
                                            </td>
                                            <td>
                                                {{ $info->origin }}
                                            </td>
                                            <td>
                                                {{ $info->unit }}
                                            </td>
                                            <td>
                                                {{ $info->order_qty }}
                                            </td>
                                            <td>
                                                {{ $info->stock }}
                                            </td>
                                            <td>
                                                {{ $info->recommended_qty }}
                                            </td>
                                            <td>
                                                {{ number_format($info->unit_price) }}
                                            </td>
                                            <td>
                                                {{ number_format($info->total_money) }}
                                            </td>
                                            <td>
                                                {{ $info->note }}
                                            </td>
                                        </tr>
                                        <p style="display: none">{{$i++}}</p>
                                    @endforeach
                                    <tr>
                                        <td colspan="9" style="text-align: right">Tổng cộng</td>
                                        <td>
                                            {{ number_format($total_money) }}
                                        </td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </form>
                            </table>
                        </div>

                        <h5 class="d-flex justify-content-center m-3">(Bằng chữ:
                            ...........................................................................................................................)</h5>
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
                @if(Auth::user()->menuroles == 'trk')
                    <div class="col-md-3 noPrint">
                        <form method="post"
                              action="{{ route('document.approve', ['id'=>$code[0]->id]) }}">
                            @csrf
                            <button class="btn btn-primary badge badge-primary font-size-14 noPrint"
                                    style="width: 100%; height: 36px"
                                    @if($code[0]->can_edit == 0)
                                    disabled
                                    @endif
                                    type="submit">
                                @if($code[0]->status == 'accept')
                                    Đã phê duyệt
                                @elseif($code[0]->status == 'cancel')
                                    Đã từ chối
                                @else
                                    Phê duyệt
                                @endif
                            </button>
                        </form>
                    </div>
                    <div class="col-md-3 noPrint">
                        <form method="post"
                              action="{{ route('document.refuse', ['id'=>$code[0]->id]) }}">
                            @csrf
                            <button class="btn btn-danger badge badge-danger font-size-14 noPrint"
                                    style="width: 100%; height: 36px"
                                    @if($code[0]->can_edit == 0)
                                    disabled
                                    @endif
                                    type="submit">Từ chối
                            </button>
                        </form>
                    </div>
                @else
                    <div class="col-md-5">
                        <button class="btn btn-danger badge badge-danger font-size-14 noPrint"
                                style="width: 100%; height: 36px"
                                disabled
                                type="submit">
                            @if($code[0]->status == 'accept')
                                Đã phê duyệt
                            @elseif($code[0]->status == 'cancel')
                                Đã từ chối
                            @else
                                Chờ phê duyệt
                            @endif
                        </button>
                    </div>
                @endif
                @if(Auth::user()->menuroles == 'ptb')
                        <div class="col-md-2 noPrint">
                            <a class="btn btn-danger font-size-14 noPrint @if($code[0]->can_edit == 0) disabled @endif"
                               role="button"
                               href="{{ route('document.edit', ['id'=>$code[0]->id]) }}"
                               style="width: 100%; height: 36px;">
                                Sửa
                            </a>
                        </div>
                @endif
                <div class="@if(Auth::user()->menuroles == 'trk') col-md-5 @elseif(Auth::user()->menuroles == 'ktv') col-md-5 @else col-md-2 @endif noPrint">
                    <button type="button" style="width: 100%; height: 36px" onclick="window.print()"
                            class="btn btn-info badge badge-info font-size-14">
                        In văn bản
                    </button>
                </div>
                @if(Auth::user()->menuroles == 'ptb')
                    <div class="col-md-2 noPrint">
                        <form method="post"
                              action="{{ route('document.export', ['id'=>$code[0]->id]) }}">
                            @csrf
                            <button class="btn btn-danger badge badge-danger font-size-14 noPrint"
                                    style="width: 100%; height: 36px"
                                    @if($code[0]->can_export==0) disabled @endif
                                    type="submit">
                                @if($code[0]->is_export==0)
                                    Tạo phiếu bàn giao
                                @else
                                    Đã tạo phiếu bàn giao
                                @endif
                            </button>
                        </form>
                    </div>
                @endif
                <div class="@if(Auth::user()->menuroles == 'ktv') col-md-2 @else col-md-1 @endif noPrint">
                    <a class="btn btn-outline-dark font-size-14 noPrint"
                       href="{{ route('document.index') }}"
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
    <script>
        $(document).on('click', '#getMessage', function (e) {
            e.preventDefault();
            let url = $(this).data('url');
            $('.message-modal').html('');
            $('#modal-loader').show();
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
                .done(function (data) {
                    $('.message-modal').html('');
                    $('.message-modal').html(data); // load response
                    $('#modal-loader').hide();        // hide ajax loader
                })
                .fail(function () {
                    $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Đã có lỗi sảy ra, vui lòng thử lại sau.');
                    $('#modal-loader').hide();
                });
        });
    </script>
@endsection
