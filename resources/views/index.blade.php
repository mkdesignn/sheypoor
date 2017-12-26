@extends("master")
@section("header")
    <title>sheypoor.ir</title>
    <meta name="description" content="هدف ایجاد وبسایت چیزی نیست جز به اشتراک گذاشتن مطالب و دانستنیهای خود . امیدوارم با موضوعات و لینکهای آموزشی که در این وبسایت قرار میدهم 1 پله شما را از آن چیزی که میدانستید بالا ببرم . در غیر اینصورت امیدوارم با استفاده کردن از مطالب وبسایت خرسند شده باشید.">
    <meta name="keywords" content="کد دیزاین, codedesign, آموزش PHp, jQuery, Vue.js, laravel framework">
@endsection
@section("content")

    <main class="container content-wrap">
        <!-- col-lg-9 col-md-9 col-sm-8 -->
        <table class="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>نام</td>
                    <td>مدل</td>
                    <td><a href="?{{ Request::getQueryString() === null ? 'price=asc' :  ( str_contains(Request::getQueryString(), 'price=asc' ) ?
                     str_replace("price=asc", "price=desc", Request::getQueryString()) : ( str_contains(Request::getQueryString(), 'price=desc' ) ?
                      str_replace("price=desc", "price=asc", Request::getQueryString()) : Request::getQueryString().'&price=asc'  ) )   }}">قیمت</a></td>
                    <td><a href="?{{ Request::getQueryString() === null ? 'created_at=asc' :  ( str_contains(Request::getQueryString(), 'created_at=asc' ) ?
                     str_replace("created_at=asc", "created_at=desc", Request::getQueryString()) : ( str_contains(Request::getQueryString(), 'created_at=desc' ) ?
                      str_replace("created_at=desc", "created_at=asc", Request::getQueryString()) : Request::getQueryString().'&created_at=asc' ) ) }}">تاریخ ایجاد</a></td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $key => $row)
                    <tr>
                        <td>{{$row->id}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->model}}</td>
                        <td>{{$row->price}}</td>
                        <td>{{$row->created_at}}</td>
                        <td><a href="{{action('HomeController@getShow', $row->id)}}">نمایش</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $rows->appends(["created_at"=>Request::get("created_at"), "price"=>Request::get("price")])->links() }}
    </main>
@endsection

<script>



</script>