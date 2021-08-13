<?php date_default_timezone_set("Asia/Bangkok"); ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@yield('title')
    <meta content="Trang web quản lý thiết bị khoa CNTT - Trường CĐN Bách Khoa Hà Nội" name="description">
    <meta content="Mai Duy Đức - LTMT2K10" name="author">
<!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets\apps\assets\images\favicon.ico') }}">
@yield('link')
<!-- Bootstrap Css -->
    <link href="{{ asset('assets\apps\assets\css\bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{ asset('assets\apps\assets\css\icons.min.css') }}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{ asset('assets\apps\assets\css\app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">
</head>

<body data-sidebar="dark">
<!-- Begin page -->
<div id="layout-wrapper">

@include('apps.partials.header')
<!-- ========== Left Sidebar Start ========== -->
@include('apps.partials.sidebar')
<!-- Left Sidebar End -->
    <!-- Begin main content-->
    <div class="main-content">
        <!-- Begin Page-content -->
        <div class="page-content">
        @yield('content')
        <!-- End Page-content -->
        </div>
        @include('apps.partials.footer')
    </div>
    <!-- end main content-->
</div>
<div class="modal fade" id="messageBoard" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content message-modal">

        </div>
    </div>
</div>
<!-- END layout-wrapper -->

<!-- JAVASCRIPT -->
<script src="{{ asset('assets\apps\assets\libs\jquery\jquery.min.js') }}"></script>
<script src="{{ asset('assets\apps\assets\libs\bootstrap\js\bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets\apps\assets\libs\metismenu\metisMenu.min.js') }}"></script>
<script src="{{ asset('assets\apps\assets\libs\simplebar\simplebar.min.js') }}"></script>
<script src="{{ asset('assets\apps\assets\libs\node-waves\waves.min.js') }}"></script>
<!-- App js -->
@yield('js')
<script src="{{ asset('assets\apps\assets\js\sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets\apps\assets\js\pages\materialdesign.init.js') }}"></script>

<script src="{{ asset('assets\apps\assets\js\app.js') }}"></script>

{{--@include('sweetalert::alert')--}}
<script>
    $(document).on('click', '#getMessage', function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        $('.message-modal').html('');
        $('#modal-loader').show();
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
            .done(function (data) {
                // console.log(data);
                $('.message-modal').html('');
                $('.message-modal').html(data); // load response
                $('#modal-loader').hide();        // hide ajax loader
            })
            .fail(function () {
                $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Đã có lỗi sảy ra, vui lòng thử lại sau!');
                $('#modal-loader').hide();
            });
    });
</script>
</body>

</html>
