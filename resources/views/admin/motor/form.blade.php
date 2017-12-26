<div class="wrapper" id="wrapper">
    {{ !empty(Session::get('msg'))? message(Session::get('msg')):"" }}
    {{errors($errors)}}
    {!! Form::model($motor, ["url"=>$url, "enctype"=>'multipart/form-data']) !!}
    <p>
        {{$form_title}}
    </p>
    <hr style="border:1px solid rgba(42,42,42,.1)"/>
    <div class="row" style="overflow:auto;margin-bottom:20px;">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <h4>
                اطلاعات موتور
            </h4>
        </div>
        <div class="col-md-4">
            <file-preview :label="file_preview.label"  :inputname="file_preview.inputname" :id="file_preview.id"
                          :file="file_preview.file" :height="file_preview.height"></file-preview>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-4 pull-right right">
                    <div class="form-group">
                        <label for="inputEmail">نام موتور</label>
                        <div class="input-group">
                            {!!Form::text("name", null, array("class"=>'form-control autosizeme', 'v-model'=>'motor.name', "style"=>"height:40px;", "placeholder"=>"..."))!!}
                            <span class="input-group-addon icomoon-uniE04B" style="font-size:large;"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pull-right right">
                    <div class="form-group">
                        <label for="inputEmail">مدل موتور</label>
                        <div class="input-group">
                            {!!Form::text("model", null, array("class"=>'form-control autosizeme', 'v-model'=>"motor.model", "style"=>"height:40px;", "placeholder"=>"..."))!!}
                            <span class="input-group-addon icomoon-uniE04B" style="font-size:large;"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pull-right right">
                    <div class="form-group">
                        <label for="inputEmail">رنگ موتور</label>
                        <div class="input-group">
                            {!!Form::color("color", null, array("class"=>'form-control autosizeme', 'v-model'=>'motor.color', "tabindex"=>"0", "style"=>"height:40px;", "placeholder"=>"..."))!!}
                            <span class="input-group-addon icomoon-uniE04B" style="font-size:large;"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pull-right right">
                    <div class="form-group">
                        <label for="inputEmail">ورن موتور</label>
                        <div class="input-group">
                            {!!Form::text("weight", null, array("class"=>'form-control autosizeme', 'v-model'=>'motor.weight', "style"=>"height:40px;", "placeholder"=>"..."))!!}
                            <span class="input-group-addon icomoon-uniE04B" style="font-size:large;"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pull-right right">
                    <div class="form-group">
                        <label for="inputEmail">قیمت موتور</label>
                        <div class="input-group">
                            {!!Form::text("price", null, array("class"=>'form-control autosizeme', 'v-model'=>'motor.price', "style"=>"height:40px;", "placeholder"=>"..."))!!}
                            <span class="input-group-addon icomoon-uniE04B" style="font-size:large;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <hr>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <input type="submit" value="{{$button}}" class="btn btn-primary"/>
        </div>
    </div>
    {!! Form::close() !!}
</div>

@section("script")

    <script>
        var data = {
           file_preview:{
               label: 'عکس',
               inputname: 'image',
               id: 'image',
               file: '{{url()->to('/')."/uploads/".$motor->image}}',
               height: '100px'
           },
           motor:{
               name: '{{$motor->name}}',
               model: '{{$motor->model}}',
               weight: '{{$motor->weight}}',
               price: '{{$motor->price}}',
               color: '{{$motor->color}}'
           }
        }
    </script>

    {!! Html::script("js/motorbike-form.js") !!}
@endsection