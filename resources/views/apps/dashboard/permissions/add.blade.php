@extends('layouts.app')

@section('title')
    <title>Permission Create</title>
@endsection
@section('link')
    <link href="{{ asset('assets\libs\select2\css\select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Permission Create</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Permissions</a></li>
                            <li class="breadcrumb-item active">Permission Create</li>
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
                            <form method="post" action="{{ route('permission.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label">Module</label>
                                    <select name="module" class="form-control select2-search-disable">
                                        <option selected disabled hidden>Chọn Module</option>
                                        @foreach(config('permissions.modules') as $modules => $item)
                                            <option value="{{ $modules }}:{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="formrow-display-name-input">Quyền</label>
                                        <select name="actions[]" class="form-control select2-search-disable select2-init"
                                                multiple>
                                            @foreach(config('permissions.actions') as $action => $item)
                                                <option value="{{ $action }}:{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Đồng ý</button>
                                    <a href="{{ route('permission.index') }}" class="btn btn-danger w-md">Hủy</a>
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
    <script src="{{ asset('js\roles\js\checkbox.js') }}"></script>
    <script src="{{ asset('assets\libs\select2\js\select2.min.js') }}"></script>
    <script src="{{ asset('assets\js\pages\form-advanced.init.js') }}"></script>

    <script>
        $('.select2-init').select2({
            'placeholder': 'Chọn hành động',
        })
    </script>
@endsection
