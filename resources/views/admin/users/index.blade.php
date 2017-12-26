@extends("admin.master")
@section("content")
    {!! Breadcrumbs::render('user.index') !!}
    <div class="wrapper" id="wrapper">
        <div class="row">
            <div class="col-md-12">
                {{ !empty(Session::get('msg'))? message(Session::get('msg')):"" }}
                {{errors($errors)}}
                <div id="data_grid">
                    <datagridview :head="head" :url="url"></datagridview>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")


    <script>
        var data = {
            url: "{{action('UserController@getIndex')}}",
            head: {
                fake_id  : "#",
                name:    'نام',
                family:  'نام خانوادگی',
                email:   'ایمیل',
                type:    'نوع',
                sex:     'جنسیت',
                status:  'وضعیت'
            },
            buttons:{
                edit:{
                    label: "ویرایش",
                    btnClass: "btn btn-warning",
                    url: "{{action('UserController@getIndex')}}/edit/{id}",
                    action: 'without-confirm',
                    style: "font-size:smaller;margin-left:10px;"
                },
                remove:{
                    label: "حذف",
                    btnClass: "btn btn-danger",
                    url: "{{action('UserController@getIndex')}}/delete/{id}",
                    action: 'confirm',
                    confirm_text: 'از حذف این رکورد مطمئن هستید ؟',
                    style: "font-size:smaller;margin-left:10px;"
                }
            }
        }
    </script>


    {!! Html::script("js/invoice-index.js") !!}

@endsection