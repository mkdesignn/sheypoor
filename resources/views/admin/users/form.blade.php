<div class="wrapper">
    {{ !empty(Session::get('msg'))? message(Session::get('msg')):"" }}
    {{errors($errors)}}
    {!! Form::model($user ,["url"=>$action]) !!}
    <p>
        اطلاعات شخصی
    </p>
    <hr style="border:1px solid rgba(42,42,42,.1)"/>
    <div class="row" style="overflow:auto;margin-bottom:20px;">
        <div class="col-md-3 pull-right right">
            <div class="form-group">
                <label for="inputEmail">نام</label>
                <div class="input-group">
                    {!!Form::text("name", null, array("class"=>'form-control autosizeme', "style"=>"height:40px;", "placeholder"=>"..."))!!}
                    <span class="input-group-addon icomoon-uniE04B" style="font-size:large;"></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 pull-right right">
            <div class="form-group">
                <label for="inputEmail">نام خانوادگی</label>
                <div class="input-group">
                    {!!Form::text("family", null, array("class"=>'form-control autosizeme', "tabindex"=>"0", "style"=>"height:40px;", "placeholder"=>"..."))!!}
                    <span class="input-group-addon icomoon-uniE04B" style="font-size:large;"></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 pull-right right">
            <div class="form-group">
                <label for="inputEmail">تاریخ تولد</label>
                <div class="input-group">
                    {!!Form::text("birth_date", null, array("class"=>'form-control autosizeme', "style"=>"height:40px;", "placeholder"=>"..."))!!}
                    <span class="input-group-addon icomoon-uniE04B" style="font-size:large;"></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 pull-right right">
            <div class="form-group">
                <label for="inputEmail">شماره شناسنامه</label>
                <div class="input-group">
                    {!!Form::text("id_number", ( $user->count() > 0) ? $user->meta->id_number: "", array("class"=>'form-control autosizeme', "style"=>"height:40px;", "placeholder"=>"..."))!!}
                    <span class="input-group-addon icomoon-uniE04B" style="font-size:large;"></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 pull-right right">
            <div class="form-group">
                <label for="inputEmail">کد ملی</label>
                <div class="input-group">
                    {!!Form::text("national_number", ($user->count() > 0) ? $user->meta->national_number: "", array("class"=>'form-control autosizeme', "style"=>"height:40px;", "placeholder"=>"..."))!!}
                    <span class="input-group-addon icomoon-uniE04B" style="font-size:large;"></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 pull-right right">
            <div class="form-group">
                <label for="inputEmail">جنسیت</label>
                <div class="input-group">
                    {!!Form::select("sex", ["مرد"=>"مرد", "زن"=>"زن"], null, array("class"=>'form-control autosizeme', "style"=>"height:40px;"))!!}
                    <span class="input-group-addon icomoon-uniE04B" style="font-size:large;"></span>
                </div>
            </div>
        </div>
    </div>

    <p>
        اطلاعات ارتباطی
    </p>
    <hr style="border:1px solid rgba(42,42,42,.1)"/>
    <div class="row">
        <div class="col-md-3 pull-right right">
            <div class="form-group">
                <label for="inputEmail">تلفن</label>
                <div class="input-group">
                    {!!Form::text("phone_number", null, array("class"=>'form-control autosizeme', "style"=>"height:40px;", "placeholder"=>"..."))!!}
                    <span class="input-group-addon icomoon-uniE04B" style="font-size:large;"></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 pull-right right">
            <div class="form-group">
                <label for="inputEmail">شماره همراه</label>
                <div class="input-group">
                    {!!Form::text("cell_number", null, array("class"=>'form-control autosizeme', "style"=>"height:40px;", "placeholder"=>"..."))!!}
                    <span class="input-group-addon icomoon-uniE04B" style="font-size:large;"></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 pull-right right">
            <div class="form-group">
                <label for="inputEmail">فکس</label>
                <div class="input-group">
                    {!!Form::text("fax", null, array("class"=>'form-control autosizeme', "style"=>"height:40px;", "placeholder"=>"..."))!!}
                    <span class="input-group-addon icomoon-uniE04B" style="font-size:large;"></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 pull-right right">
            <div class="form-group">
                <label for="inputEmail">وبسایت</label>
                <div class="input-group">
                    {!!Form::text("website", null, array("class"=>'form-control autosizeme', "style"=>"height:40px;", "placeholder"=>"..."))!!}
                    <span class="input-group-addon icomoon-uniE04B" style="font-size:large;"></span>
                </div>
            </div>
        </div>
        <div class="col-md-4 pull-right right">
            <div class="form-group">
                <label for="inputEmail">ایمیل</label>
                <div class="input-group">
                    {!!Form::text("email", null, array("class"=>'form-control autosizeme', "style"=>"height:40px;", "placeholder"=>"..."))!!}
                    <span class="input-group-addon icomoon-uniE04B" style="font-size:large;"></span>
                </div>
            </div>
        </div>
        <div class="col-md-12 pull-right right">
            <div class="form-group">
                <label for="inputEmail">آدرس</label>
                <div class="input-group">
                    {!!Form::text("address", null, array("class"=>'form-control autosizeme', "style"=>"height:40px;", "placeholder"=>"..."))!!}
                    <span class="input-group-addon icomoon-uniE04B" style="font-size:large;"></span>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <p>
        اطلاعات شغلی
    </p>
    <hr style="border:1px solid rgba(42,42,42,.1)"/>
    <div class="row">
        <div class="col-md-4 pull-right right">
            <div class="form-group">
                <label for="inputEmail">نقش</label>
                <div class="input-group">
                    {!!Form::select("role_id", ["6"=>"ادمین"], null,  array("class"=>'form-control autosizeme', "style"=>"height:40px;"))!!}
                    <span class="input-group-addon icomoon-uniE04B" style="font-size:large;"></span>
                </div>
            </div>
        </div>
    </div>
    @if( $type === "edit" )
        <p>
            اطلاعات ورود
        </p>
        <hr style="border:1px solid rgba(42,42,42,.1)"/>
        <div class="row">
            <div class="col-md-4 pull-right right">
                <div class="form-group">
                    <label for="inputEmail">نام کاربری</label>
                    <div class="input-group">
                        {!!Form::text("username", null,  array("class"=>'form-control autosizeme', "style"=>"height:40px;"))!!}
                        <span class="input-group-addon icomoon-uniE04B" style="font-size:large;"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pull-right right">
                <div class="form-group">
                    <label for="inputEmail">کلمه عبور</label>
                    <div class="input-group">
                        {!!Form::password("password",  array("class"=>'form-control autosizeme', "style"=>"height:40px;"))!!}
                        <span class="input-group-addon icomoon-uniE04B" style="font-size:large;"></span>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <hr>
    <input type="submit" value="{{$button}}" class="btn btn-primary"/>
    {!! Form::close() !!}
</div>

@section("script")
    <script>
        jQuery(function($){
            $("[name=birth_date]").persianDatepicker({
                formatDate: "YYYY/0M/0D"
            });
        })
    </script>
@endsection