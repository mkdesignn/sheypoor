@extends("admin.master")
@section("content")
    {!! Breadcrumbs::render('user.index') !!}
    <div class="wrapper">
        <search url="{{action('UserController@getIndex')}}"></search>
        <row_per_page url="{{action('UserController@getIndex')}}"></row_per_page>
        <table class="data_grid">
            <thead>
            <tr>
                <td>
                    نام
                </td>
                <td>
                    نام خانوادگی
                </td>
                <td>
                    وضعیت
                </td>
                <td>
                    نقش
                </td>
                <td>
                    عملیات
                </td>
            </tr>
            </thead>
            <tbody>
                <tr is="post" :post="posts"
                    :filter="{fields:['name', 'family', 'status_name', 'role_name']}"
                    delete_link="{{action('UserController@getDelete')}}"
                    edit_link='{{action('UserController@getEdit')}}'></tr>

            </tbody>
        </table>
        <paginate style="float:right" :paginate="paginate" url="{{action('UserController@getIndex')}}"></paginate>


    </div>
@endsection

@section("script")
    <script>
        jQuery(function(){
            var vue = new Vue({
                el:".wrapper",
                data:{
                    posts:"",
                    paginate:"",
                    row_per_page:"",
                    search:""
                }
            })
        })
    </script>
@endsection