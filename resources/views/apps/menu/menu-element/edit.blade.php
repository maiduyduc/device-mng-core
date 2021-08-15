@extends('apps.layouts.app')

@section('title')
    <title>Chỉnh sửa menu</title>
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
                    <h4 class="mb-0 font-size-18">Chỉnh sửa menu</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý menu con</a></li>
                            <li class="breadcrumb-item active">Chỉnh sửa menu</li>
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
                            <form method="post" action="{{ route('menu.update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $menuElement->id }}" id="menuElementId"/>
                                <div class="form-group">
                                    <label for="menu">Chọn menu chính</label>
                                    <select class="form-control select2-search-disable select2-init" id="menu"
                                            name="menu">
                                        @foreach($menulist as $menu1)
                                            @if($menu1->id == $menuElement->menu_id  )
                                                <option value="{{ $menu1->id }}" selected>{{ $menu1->name }}</option>
                                            @else
                                                <option value="{{ $menu1->id }}">{{ $menu1->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Role có quyền truy cập menu</label>
                                    <div class="d-flex justify-content-between">
                                        @foreach($roles as $role)
                                            <div class="custom-control custom-checkbox custom-checkbox-primary">
                                                <?php
                                                $temp = false;
                                                foreach ($menuroles as $menurole) {
                                                    if ($role == $menurole->role_name) {
                                                        $temp = true;
                                                    }
                                                }
                                                if($temp === true){
                                                ?>
                                                <input type="checkbox"
                                                       name="role[]"
                                                       value="{{ $role }}"
                                                       id="checkbox{{ $role }}"
                                                       checked
                                                       class="custom-control-input">
                                                <label class="custom-control-label text-danger"
                                                       style="font-size: 14px"
                                                       for="checkbox{{ $role }}">
                                                    {{--                                                    {{ $role }}--}}
                                                    @foreach(config('my-config.role-name') as $role1 => $name)
                                                        @if($role1 == $role)
                                                            {{ $name }}
                                                        @endif
                                                    @endforeach
                                                </label>
                                                <?php
                                                }else{
                                                ?>
                                                <input type="checkbox"
                                                       name="role[]"
                                                       value="{{ $role }}"
                                                       id="checkbox{{ $role }}"
                                                       class="custom-control-input">
                                                <label class="custom-control-label text-danger"
                                                       style="font-size: 14px"
                                                       for="checkbox{{ $role }}">
                                                    {{--                                                    {{ $role }}--}}
                                                    @foreach(config('my-config.role-name') as $role1 => $name)
                                                        @if($role1 == $role)
                                                            {{ $name }}
                                                        @endif
                                                    @endforeach
                                                </label>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="formrow-name-input">Tên menu</label>
                                    <input type="text" name="name"
                                           required autofocus
                                           value="{{ $menuElement->name }}"
                                           placeholder="{{ __('Tên menu') }}"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="formrow-name-input">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="type">Loại</label>
                                    <select class="form-control select2-search-disable select2-init" id="type"
                                            name="type">
                                        @if($menuElement->slug === 'link')
                                            <option value="link" selected>Link</option>
                                        @else
                                            <option value="link">Link</option>
                                        @endif
                                        @if($menuElement->slug === 'title')
                                            <option value="title" selected>Title</option>
                                        @else
                                            <option value="title">Title</option>
                                        @endif
                                        @if($menuElement->slug === 'dropdown')
                                            <option value="dropdown" selected>Dropdown</option>
                                        @else
                                            <option value="dropdown">Dropdown</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group" id="div-href">
                                    <label for="formrow-href">Đường dẫn</label>
                                    <input type="text" name="href"
                                           value="{{ $menuElement->href }}"
                                           placeholder="{{ __('Ví dụ: /trangchu') }}"
                                           class="form-control @error('href') is-invalid @enderror"
                                           id="formrow-href">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group" id="div-dropdown-parent">
                                    <label for="parent">Menu cha</label>
                                    <input type="hidden" id="parentId" value="{{ $menuElement->parent_id }}"/>
                                    <select class="form-control select2-search-disable select2-init" name="parent"
                                            id="parent">

                                    </select>
                                </div>
                                <div class="form-group" id="div-icon">
                                    <label for="formrow-icon">Icon</label>
                                    <input type="text" name="icon"
                                           value="{{ $menuElement->icon }}"
                                           placeholder="{{ __('Icon') }}"
                                           class="form-control @error('icon') is-invalid @enderror"
                                           id="formrow-icon">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-around">
                                    <button type="submit" class="btn btn-primary w-md col-md-5">Hoàn thành</button>
                                    <a href="{{ route('menu.index', ['menu' => $menuElement->menu_id]) }}"
                                       class="btn btn-danger w-md col-md-5">Hủy</a>
                                </div>
                            </form>
                            <div class="col-lg-6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets\apps\assets\libs\select2\js\select2.min.js') }}"></script>
    <script>
        $('.select2_init').select2({
            'placeholder': 'Chọn vai trò'
        })
    </script>
    <!-- form advanced init -->
    <script src="{{ asset('assets\apps\assets\js\pages\form-advanced.init.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/menu-create.js') }}"></script>
@endsection
