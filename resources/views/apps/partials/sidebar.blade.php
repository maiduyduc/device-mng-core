<div class="vertical-menu">

    <div data-simplebar="" class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="/home" class="waves-effect">
                        <i class="mdi mdi-home"></i>
                        <span>Trang chủ</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-clipboard-text-outline"></i>
                        <span>Kiểm kê</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
{{--                            <a href="#">Kiểm kê trên máy</a>--}}
                            <a data-toggle="modal" id="getMessage" data-target="#messageBoard" data-url="{{ url('developing')}}" href="#!"> Kiểm kê trên máy </a>
                        </li>
                        <li>
{{--                            <a href="#">Kiểm kê trên sổ</a>--}}
                            <a data-toggle="modal" id="getMessage" data-target="#messageBoard" data-url="{{ url('developing')}}" href="#!"> Kiểm kê trên sổ </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-edit"></i>
                        <span>Quản lý cấp phát</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('device-plan.index') }}">Lập dự trù</a></li>
                        <li><a href="{{ route('document.index') }}">Nhập thiết bị</a></li>
                        <li><a href="{{ route('handover.index') }}">Bàn giao thiết bị</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-eye"></i>
                        <span>Theo dõi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('history.index') }}">Nhật ký</a></li>
                        <li>
                            <a href="{{ route('liquidate.index') }}">Tổng hợp thanh lý</a>
{{--                            <a data-toggle="modal" id="getMessage" data-target="#messageBoard" data-url="{{ url('developing')}}" href="#!"> Tổng hợp thanh lý </a>--}}
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-book-search-outline"></i>
                        <span>Tìm kiếm, Báo cáo</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
{{--                            <a href="#">Tìm kiếm</a>--}}
                            <a data-toggle="modal" id="getMessage" data-target="#messageBoard" data-url="{{ url('developing')}}" href="#!"> Tìm kiếm </a>
                        </li>
                        <li>
{{--                            <a href="#">Báo cáo</a>--}}
                            <a data-toggle="modal" id="getMessage" data-target="#messageBoard" data-url="{{ url('developing')}}" href="#!"> Báo cáo </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-chip"></i>
                        <span>Quản lý hệ thống</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
{{--                        <li><a href="{{ route('category-device.index') }}">Danh mục thiết bị</a></li>--}}
                        <li><a href="javascript: void(0);" class="has-arrow">Quản lý thiết bị</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('category-device.index') }}">Danh mục thiết bị</a></li>
                                <li><a href="{{ route('device.index') }}">Danh sách thiết bị</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('room.index') }}">Quản lý phòng</a></li>
                        <li><a href="javascript: void(0);" class="has-arrow">Quản lý người dùng</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('user.index') }}">Danh sách người dùng</a></li>
                                <li><a href="{{ route('role.index') }}">Vai trò người dùng</a></li>
                                <li><a href="{{ route('permission.index') }}">Phân quyền</a></li>
                            </ul>
                        </li>

                        <li>
{{--                            <a href="#">Sao lưu phục hồi</a>--}}
                            <a data-toggle="modal" id="getMessage" data-target="#messageBoard" data-url="{{ url('developing')}}" href="#!"> Sao lưu phục hồi </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="waves-effect">
                        <i class="mdi mdi-logout"></i>
                        <span>Thoát</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
