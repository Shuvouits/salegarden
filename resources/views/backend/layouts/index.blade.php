<?php
echo header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
echo header("Cache-Control: post-check=0, pre-check=0", false);
echo header("Pragma: no-cache");
echo header('Content-Type: text/html');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Tree plant</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="_token" content="{!! csrf_token() !!}" />
        @include('backend/layouts/headerScript')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @include('backend/layouts/header')
            @include('backend/layouts/sidebarSuperAdmin')            
            @yield('content')
            @include('backend/layouts/footer')
        </div>
    </body>
</html>