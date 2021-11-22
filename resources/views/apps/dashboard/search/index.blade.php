@extends('apps.layouts.app')

@section('title')
    <title>Tìm kiếm</title>
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
                    <h4 class="mb-0 font-size-18">Tìm kiếm thiết bị</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tìm kiếm - Báo cáo</a></li>
                            <li class="breadcrumb-item active">Tìm kiếm thiết bị</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('search.find') }}" method="get">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="control-label">Tìm kiếm theo</label>
                                        <select name="key" id="key"
                                                class="form-control select2-search-disable select2-init">
                                            <option selected value="name">
                                                Tên thiết bị
                                            </option>
                                            <option value="category">Chủng loại</option>
                                            <option value="room">Phòng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <label for="device">Thông tin tìm kiếm</label>
                                        <div class="row">
                                            <div class="col d-none" id="with_cate">
                                                <div class="position-relative">
                                                    <select name="category_id" style="width: 100%"
                                                            class="form-control select2-search-disable select2-init">
                                                        @foreach($categories as $category)
                                                            <option
                                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col d-none" id="with_room">
                                                <div class="position-relative">
                                                    <select name="room_id" style="width: 100%"
                                                            class="form-control select2-search-disable select2-init">
                                                        @foreach($rooms as $room)
                                                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col" id="device_only">
                                                <div class="position-relative">
                                                    <input type="text" name="device" placeholder="Nhập tên thiết bị"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit"
                                                        class="btn btn-primary chat-send w-md waves-effect waves-light">
                                                    <span class="d-none d-sm-inline-block mr-2">Tìm kiếm</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets\apps\assets\libs\select2\js\select2.min.js') }}"></script>

    <!-- form advanced init -->
    <script src="{{ asset('assets\apps\assets\js\pages\form-advanced.init.js') }}"></script>

    {{--    <script src="{{ asset('js/axios.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('js/menu-create.js') }}"></script>--}}
    <script>
        this.toggleInput = function () {
            var value = document.getElementById("key").value;

            if (value === 'category') {
                // document.getElementById('device_only').classList.add('d-none');
                document.getElementById('with_cate').classList.remove('d-none');
                document.getElementById('with_room').classList.add('d-none');
            } else if (value === 'room') {
                // document.getElementById('device_only').classList.add('d-none');
                document.getElementById('with_cate').classList.add('d-none');
                document.getElementById('with_room').classList.remove('d-none');
            } else {
                // document.getElementById('device_only').classList.add('d-none');
                document.getElementById('with_cate').classList.add('d-none');
                document.getElementById('with_room').classList.add('d-none');
            }
        };

        this.toggleInput();

        document.getElementById("key").onchange = function () {
            self.toggleInput();
        };
    </script>
@endsection
