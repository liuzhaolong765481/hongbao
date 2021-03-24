<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{env('APP_NAME')}}</title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no,viewport-fit=cover">
    <meta name="format-detection" content="telephone=yes,email=no,address=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-touch-fullscreen" content="yes">
    <link rel="stylesheet" href="{{asset('plugin/layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{asset('css/public.css').'?'.time()}}">
    <script src="{{asset('js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('plugin/layer/layer.js')}}"></script>
    <script src="{{asset('plugin/layui/layui.all.js')}}"></script>
</head>
<body>

<div class="clear"></div>

</body>


</html>