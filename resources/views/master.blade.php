<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Mohammad Kaab">
    <meta property="og:image" content="{{url()->to("/")."/codedesign_banner.png"}}">
    <link rel="icon" href="{{url()->to("/")}}/codedesign.ico" type="image/x-icon">
    @yield("header")

    <link href="{{url()->to('/')."/style/bootstrap.min.css"}}" rel="stylesheet" type="text/css">
    {!! Html::style("style/style.css") !!}
</head>
<body>
    <div class="header" style="height:80px;width:100%;background-color:#424242;">
    </div>
    <br>
    <br>
    @yield("content")
    <div class="footer" style="height:80px;width:100%;background-color:#424242;"></div>
    {!! Html::script('js/amcharts.js')!!}
    {!! Html::script('js/ease.js')!!}
    {!! Html::script('js/ease2.js')!!}
    {!! Html::script('js/serial.js')!!}
    {!! Html::script('js/vendor-js.js')!!}
</body>
</html>
