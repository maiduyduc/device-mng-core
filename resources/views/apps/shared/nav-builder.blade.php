<?php
if (!function_exists('renderDropdown')) {
    function renderDropdown($data)
    {
        if (array_key_exists('slug', $data) && $data['slug'] === 'dropdown') {
            echo '<li>';
            echo '<a href="javascript: void(0);" class="has-arrow waves-effect font-size-16">';
            if ($data['hasIcon'] === true) {
                echo '<i class="' . $data['icon'] . '"></i>';
            }
            echo '<span>' . $data['name'] . '</span></a>';
            echo '<ul class="sub-menu" aria-expanded="false">';
            renderDropdown($data['elements']);
            echo '</ul></li>';
        } else {
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]['slug'] === 'link') {
                    echo '<li>';
                    echo '<a class="waves-effect font-size-15" href="' . url($data[$i]['href']) . '">';
                    echo $data[$i]['name'] . '</a></li>';
                } elseif ($data[$i]['slug'] === 'dropdown') {
                    renderDropdown($data[$i]);
                }
            }
        }
    }
}
?>
<div class="vertical-menu">

    <div data-simplebar="" class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                @if(isset($appMenus['sidebar menu']))
                    @foreach($appMenus['sidebar menu'] as $menuel)
                        @if($menuel['slug'] === 'link')
                            <li>
                                <a class="waves-effect font-size-16" href="{{ url($menuel['href']) }}">
                                    @if($menuel['hasIcon'] === true)
                                        @if($menuel['iconType'] === 'coreui')
                                            <i class="{{ $menuel['icon'] }}"></i>
                                        @endif
                                    @endif
                                    <span>{{ $menuel['name'] }}</span>
                                </a>
                            </li>
                        @elseif($menuel['slug'] === 'dropdown')
                            <?php renderDropdown($menuel) ?>
                        @elseif($menuel['slug'] === 'title')
                            <li class="menu-title">
                                @if($menuel['hasIcon'] === true)
                                    @if($menuel['iconType'] === 'coreui')
                                        <i class="{{ $menuel['icon'] }}"></i>
                                    @endif
                                @endif
                                <span>{{ $menuel['name'] }}</span>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>

