@extends("admin.master")
@section("content")
    {!! Breadcrumbs::render('motor') !!}
    <div class="wrapper" id="wrapper">
        <div class="row">
            <div class="col-md-12">
                {{ !empty(Session::get('msg'))? message(Session::get('msg')):"" }}
                {{errors($errors)}}
                <datagridview :head="head" :url="url"></datagridview>
            </div>
        </div>
    </div>
@endsection

@section("script")


    <script>

        var data = {
            url: "{{action('MotorController@getIndex')}}",
            head: {
                fake_id  : "#",
                name:    'نام',
                model: 'مدل',
                cc:  'سیلندر',
                weight:   'وزن',
                color:   'رنگ',
            },
            buttons:{
                edit:{
                    label: "ویرایش موتور",
                    btnClass: "btn btn-warning",
                    url: "{{action('MotorController@getIndex')}}/edit/{id}",
                    action: 'without-confirm',
                    style: "font-size:smaller;margin-left:10px;"
                },
                remove:{
                    label: 'حذف موتور',
                    btnClass: "btn btn-danger",
                    url: "{{action('MotorController@getIndex')}}/delete/{id}",
                    action: 'confirm',
                    confirm_text: 'از حذف این رکورد مطمئن هستید ؟',
                    style: "font-size:smaller;margin-left:10px;"
                }
            }
        }

    </script>

    {!! Html::script("js/motorbike-index.js") !!}
@endsection