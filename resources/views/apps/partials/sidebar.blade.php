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
                        <li>
                            <a href="{{ route('history.index') }}">Nhật ký</a>
                        </li>
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
//====================
<?php
/*
    $data = $menuel['elements']
*/

if(!function_exists('renderDropdown')){
    function renderDropdown($data){
        if(array_key_exists('slug', $data) && $data['slug'] === 'dropdown'){
            echo '<li class="c-sidebar-nav-dropdown">';
            echo '<a class="c-sidebar-nav-dropdown-toggle" href="#">';
            if($data['hasIcon'] === true && $data['iconType'] === 'coreui'){
                echo '<i class="' . $data['icon'] . ' c-sidebar-nav-icon"></i>';
            }
            echo $data['name'] . '</a>';
            echo '<ul class="c-sidebar-nav-dropdown-items">';
            renderDropdown( $data['elements'] );
            echo '</ul></li>';
        }else{
            for($i = 0; $i < count($data); $i++){
                if( $data[$i]['slug'] === 'link' ){
                    echo '<li class="c-sidebar-nav-item">';
                    echo '<a class="c-sidebar-nav-link" href="' . url($data[$i]['href']) . '">';
                    echo '<span class="c-sidebar-nav-icon"></span>' . $data[$i]['name'] . '</a></li>';
                }elseif( $data[$i]['slug'] === 'dropdown' ){
                    renderDropdown( $data[$i] );
                }
            }
        }
    }
}
?>


<div class="c-sidebar-brand">
    <img class="c-sidebar-brand-full" src="{{ url('/assets/brand/coreui-base-white.svg') }}" width="118" height="46" alt="CoreUI Logo">
    <img class="c-sidebar-brand-minimized" src="{{ url('assets/brand/coreui-signet-white.svg') }}" width="118" height="46" alt="CoreUI Logo">
</div>
<ul class="c-sidebar-nav">
    @if(isset($appMenus['sidebar menu']))
        @foreach($appMenus['sidebar menu'] as $menuel)
            @if($menuel['slug'] === 'link')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ url($menuel['href']) }}">
                        @if($menuel['hasIcon'] === true)
                            @if($menuel['iconType'] === 'coreui')
                                <i class="{{ $menuel['icon'] }} c-sidebar-nav-icon"></i>
                            @endif
                        @endif
                        {{ $menuel['name'] }}
                    </a>
                </li>
            @elseif($menuel['slug'] === 'dropdown')
                <?php renderDropdown($menuel) ?>
            @elseif($menuel['slug'] === 'title')
                <li class="c-sidebar-nav-title">
                    @if($menuel['hasIcon'] === true)
                        @if($menuel['iconType'] === 'coreui')
                            <i class="{{ $menuel['icon'] }} c-sidebar-nav-icon"></i>
                        @endif
                    @endif
                    {{ $menuel['name'] }}
                </li>
            @endif
        @endforeach
    @endif
</ul>
<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>
