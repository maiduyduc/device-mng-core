<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Đăng nhập | Trường Cao đẳng nghề Bách Khoa Hà Nội</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Trang web quản lý thiết bị khoa CNTT - Trường CĐN Bách Khoa Hà Nội" name="description">
    <meta content="Mai Duy Đức - LTMT2-K10" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets\apps\assets\images\favicon.ico') }}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets\apps\assets\css\bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{ asset('assets\apps\assets\css\icons.min.css') }}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{ asset('assets\apps\assets\css\app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">

</head>

<body>

<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-soft-primary">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">Xin chào !</h5>
                                    <p>Vui lòng đăng nhập để sử dụng các chức năng.</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="{{ asset('assets\apps\assets\images\profile-img.png') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div>
                            <a href="index.html">
                                <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{ asset('assets\apps\assets\images\logohatech.png') }}" alt=""
                                                     style="width: 95px; height: 95px"
                                                     class="rounded-circle" height="34">
                                            </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            <form method="post" class="form-horizontal" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">{{ __('Tài khoản') }}</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email" value="{{ old('email') }}" required
                                           autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Mật khẩu</label>
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input"
                                           name="remember"
                                           {{ old('remember') ? 'checked' : '' }}
                                           id="remember">
                                    <label class="custom-control-label" for="remember">Nhớ mật khẩu</label>
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">
                                        Đăng nhập
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">
                    <div>
                        <p>©
                            <script>document.write(new Date().getFullYear())</script>
                            Trường Cao đẳng nghề Bách Khoa Hà Nội
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT -->
<script src="{{ asset('assets\apps\assets\libs\jquery\jquery.min.js') }}"></script>
<script src="{{ asset('assets\apps\assets\libs\bootstrap\js\bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets\apps\assets\libs\metismenu\metisMenu.min.js') }}"></script>
<script src="{{ asset('assets\apps\assets\libs\simplebar\simplebar.min.js') }}"></script>
<script src="{{ asset('assets\apps\assets\libs\node-waves\waves.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets\apps\assets\js\app.js') }}"></script>
</body>
</html>
