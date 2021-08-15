<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="/" class="logo logo-light">
                    <span class="logo-sm">
{{--                        <img src="{{ asset('assets\images\logo-light.svg') }}" alt="" height="22">--}}
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets\apps\assets\images\logo.jpg') }}" alt="" height="50px">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ml-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                     aria-labelledby="page-header-search-dropdown">
                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..."
                                       aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="dropdown d-none d-lg-inline-block ml-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect"
                        id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    <i class="bx bx-bell"></i>
                    <span class="badge badge-danger badge-pill">1</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                     aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Thông báo </h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small"> Đánh dấu đã đọc</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar="" style="max-height: 230px;">
                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <div class="avatar-xs mr-3">
                                                <span class="avatar-title bg-danger rounded-circle font-size-16">
                                                    <i class="bx bx-info-circle"></i>
                                                </span>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">Phiếu đề nghị cấp phát mới.</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">Chu Đức Tuấn đã gửi yêu cầu cấp phát thiết bị mới.</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 phút trước</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 border-top">
                        <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-right-circle mr-1"></i> Xem thêm...
                        </a>
                    </div>
                </div>
            </div>
            <style>
                .user-icon {
                    display: none;
                }

                @media (max-width: 1199px) {
                    .user-icon {
                        display: block
                    }
                }
            </style>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-user-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="box">
                        <span class="d-none d-xl-inline-block ml-1">@if(Auth::check()) {{ Auth::user()->name }} @endif</span>
                        <i class="bx bx-user user-icon"></i>
                    </div>

                </button>

                <div class="dropdown-menu dropdown-menu-right">
                    {{--                    <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Thông--}}
                    {{--                        tin cá nhân--}}
                    {{--                    </a>--}}
                    {{--                    <a class="dropdown-item d-block" href="#"><i class="bx bx-wrench font-size-16 align-middle mr-1"></i> Cài đặt</a>--}}
                    {{--                    <div class="dropdown-divider"></div>--}}
                    <a class="dropdown-item text-danger" href="{{ route('dangxuat') }}">
                        <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Đăng xuất
                    </a>
                </div>
            </div>

        </div>
    </div>
</header>
