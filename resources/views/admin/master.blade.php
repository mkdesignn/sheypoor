<!DOCTYPE HTML>
<html style='background-color:#E5E6E6'>
<head>
    <title>{{env('WEBAPP_TITLE')}}</title>
    <meta charset='UTF-8'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{url()->to('/')."/style/bootstrap.min.css"}}" rel="stylesheet" type="text/css">
    <link href="{{url()->to('/')."/style/admin.css"}}" rel="stylesheet" type="text/css">
    <link href="{{url()->to('/')."/style/style.css"}}" rel="stylesheet" type="text/css">
    <link href="{{url()->to('/')."/style/font.css"}}" rel="stylesheet" type="text/css">
    <link href="{{url()->to('/')."style/loading.css"}}" rel="stylesheet" type="text/css">
    <link href="{{url()->to('/')."style/test.css"}}" rel="stylesheet" type="text/css">
</head>
<body>
    <style>
        .top-left-menu .notifications{
            position:relative;
            margin-right:10px;
            padding: 10px;
            display: inline-block;
            background-color: #e4e4e4;
            margin-top: 13px;
            border-radius: 2px;
            font-size: larger;
            border:1px solid rgba(42,42,42,.1);
            cursor: pointer;
            color:#424242;

        }

        .top-left-menu .notifications .badge{
            position: absolute;
            top: -6px;
            right: -7px;
            background-color: #f75b49;
            font-weight: bold;
        }

        .sidebar-toggle{
            -webkit-transition: all .5s;
            -moz-transition: all .5s;
            -ms-transition: all .5s;
            -o-transition: all .5s;
            transition: all .5s;
            position: relative;left: 20px;top: 12px;
            font-size: 16px;border-radius: 53px;width: 36px;display: inline-block;
            padding: 9px 11px;
        }

        .toggle-active{
            background-color:#f0f0f0;
        }

        .sidebar-toggle:hover{
            -webkit-transition: all .5s;
            -moz-transition: all .5s;
            -ms-transition: all .5s;
            -o-transition: all .5s;
            transition: all .5s;
            background-color:#f0f0f0;
            cursor: pointer;
        }

        .top-menu{
            position:absolute;
            top:0px;
            width:100%;
            background-color:#fff;
            padding:10px;
        }

        .top-middle-bar{
            float: right;
            overflow: auto;
            width: 30%;
            height: 60px
        }

        .top-search-bar{
            height: 100%;
            padding-top: 17px;
            width:100%;
            float:right
        }

        .top-search-bar input[type=text]{
            background-color: white;
            width: 100%;
            padding: 8px;
            border: 1px solid rgba(42,42,42,.1);
            font-size: smaller;
            font-weight: lighter;
        }

        .search_wrapper{
            position: absolute;
            top: 52px;
            right: 250px;
            z-index: 1000000;
            box-shadow: 0px 0px 1px 2px rgba(128, 128, 128, 0.05);
            padding: 20px;
            background-color: rgba(255,255,255,.9);
            border: 1px solid rgba(42,42,42,.2);
            display:none;
        }

        /* always present */
        .fade-transition {
            transition: all .9s ease;
        }

        /* .expand-enter defines the starting state for entering */
        /* .expand-leave defines the ending state for leaving */
        .fade-enter, .fade-leave {
            opacity:0;
        }

    </style>
    <!-- 3  -->

    <div class="top-menu"></div>
    <div class="search_wrapper" id="search_wrapper"></div>
    <header>
        <div class="top-right-menu" style="overflow:auto;float:right;width:250px;">
            <div class="logo" style="line-height: 1.8;text-align: right;">
                شیپور  <br>
                <b> sheypoor.com </b>
            </div>
            <span class="icomoon-uniF0C9 sidebar-toggle"></span>
        </div>
        <div class="top-middle-bar">
            <div class="top-search-bar">
                <input type="text" name="global_search" placeholder="جستجوی موضوع"/>
            </div>
        </div>
        <div class="top-left-menu" style="padding-left:20px;float:left;">
            @if( $roles->has("admin") )
                <span class="notification notifications  icomoon-notifications" data-toggle="tooltip" data-placement="bottom" title="اطلاع رسانی">
                    <span class="badge">9</span>
                </span>
            @endif
        </div>
    </header>
    <section class="content" id="app" style="background-color:#EEEEEE;clear:right;">
        <div class="below_aside"></div>
        <aside>
            <div class="user_info">
                <?php echo  avatar(Auth::user()->email, "border-radius:5px;", Auth::user()->name, Auth::user()->family, 50) ?>
                <span style="font-size:smaller;margin-right:10px;float: right;margin-top: 7px;">
                    <i style='font-size:11px;'>{{" خوش آمدید ، ".Auth::user()->name." ".Auth::user()->family}}</i>
                    <br/>
                    <i style="position:relative;top:5px;">
                        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color:#f0f0f0;margin-left:2px;font-size:smaller;">خروج</a>
                        <span>-</span>
                        <a href="#" style="color:#f0f0f0;margin-right:2px;font-size:smaller;">پروفایل</a>
                    </i>
                </span>
            </div>
            <ul class="menu" style="clear: both;padding-top: 20px;margin-right: -15px;margin-left: -15px;">
                @if( Auth::user()->type == "admin" )

                    <li class="sub-menu">
                        <a class="sub-menu-li" href="javascript:void(0)">
                            <span class="icomoon-users icon"></span>
                            کاربران
                        </a>
                        <ul class="nested-sub-menu">
                            <li class="sub-menu">
                                <span> <a href="{{route('user.index')}}"> لیست کاربران </a></span>
                            </li>
                            <li class="sub-menu">
                                <span> <a href="{{route('user.create')}}"> ایجاد کاربر </a></span>
                            </li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a class="sub-menu-li" href="javascript:void(0)">
                            <span class="icomoon-file-text2 icon"></span>
                            موتور
                        </a>
                        <ul class="nested-sub-menu">
                            <li class="sub-menu">
                                <span> <a href="{{route('motor.index')}}"> لیست موتورها </a></span>
                            </li>
                            <li class="sub-menu">
                                <span> <a href="{{route('motor.create')}}"> ایجاد موتور </a></span>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </aside>
        <div class="row" style="margin-right:250px;margin-left:0px;">

            @yield('content')
            <br class="clear"/>
            <br class="clear"/>
            <br class="clear"/>
        </div>
    </section>
    {!! Form::open(["url"=>route("logout"), "id"=>"logout-form"]) !!}
    {!! Form::close() !!}

</body>
</html>
{!! Html::script("js/axios.js") !!}
{!! Html::script("js/vendor-js.js") !!}
{!! Html::script("js/ease.js") !!}
{!! Html::script("js/ease2.js") !!}
{!! Html::script("js/bootstrap.min.js") !!}
{{--{!! Html::script("app.js") !!}--}}
@yield("script")


<style>
    .mCSB_container{
        margin-right:0px !important;
    }
</style>
<script>

    jQuery(function($){
        $(".sidebar-toggle").click(function(){
            if( parseInt($("aside").css("width")) > 0 ){
                $('aside .user_info').animate({"opacity":"0"}, 300, function(){
                    $(this).css("display", "none");
                });
                $('ul.menu').animate({"opacity":"0"}, 300, function(){
                    $(this).css("display", "none")
                    $("aside").animate({"width":"0px", "opacity":"0"}, 300, 'expoout')
                            .css("padding", "0px")
                    $("body > section > .row").animate({"margin-right":"0px"}, 300)
                    $(".below_aside").animate({"width":"0px"}, 300)
                });
                $(this).addClass("toggle-active")
            }else{
                $("aside")
                        .animate({"width":"250px", "opacity":"1"}, 300, function(){
                            $('aside .user_info').css("display", "block").animate({"opacity":"100"}, 300);
                            $('ul.menu').css("display", "block").animate({"opacity":"100"}, 300);
                        })
                        .css("padding", "15px");
                $(".below_aside").animate({"width":"250px"}, 300)
                $(this).removeClass("toggle-active")
                $("body > section > .row").animate({"margin-right":"250px"}, 300)
            }

        })

        $('[data-toggle="tooltip"]').tooltip();

        $('body').tooltip({
            selector: ".tooltips"
        });
    })

</script>