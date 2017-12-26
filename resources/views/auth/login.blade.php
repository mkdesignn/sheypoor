@extends("master")
@section("content")
    <style>
        .panel{
            width:450px;
            text-align:center;
            margin:auto;
            padding:10px;
        }

        .login_wrapper input[type=text]{
            background:url("{{url('images/user.png')}}") no-repeat 98% 6px;
            background-size: 6%;
        }

        .login_wrapper input[type=password]{
            background:url("{{url('images/password.png')}}") no-repeat 98% 6px;
            background-size: 6%;
        }

        .login_wrapper input {
            width: 100%;
            border: 1px solid rgba(42,42,42,.1);
            padding: 10px 41px 10px 10px;
        }
    </style>

    <div class="container">
        <div class="col-md-12">
            <div class="panel element_boxshadow auto" style="overflow:auto;">
                <h4 class="align_r">
                    ورود
                </h4>
                <hr>
                <div class="login_wrapper">
                    <div class="col-md-12">
                        {{ !empty(Session::get('msg'))? message(Session::get('msg')):"" }}
                        {{ errors($errors) }}
                    </div>
                    {!! Form::open(["url"=>action('Auth\LoginController@login')]) !!}
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::text("username", null, ["autocomplete"=>"off"]) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::password("password") !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" style="float: left;width: initial;padding: 6px 20px 10px 20px;" class="btn btn-primary" value="ورود"/>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    {!! Html::script("js/vendor-js.js") !!}

@endsection