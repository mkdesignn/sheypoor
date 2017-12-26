@extends("master")
@section("header")
    <title>sheypoor.ir</title>
    <meta name="description" content="هدف ایجاد وبسایت چیزی نیست جز به اشتراک گذاشتن مطالب و دانستنیهای خود . امیدوارم با موضوعات و لینکهای آموزشی که در این وبسایت قرار میدهم 1 پله شما را از آن چیزی که میدانستید بالا ببرم . در غیر اینصورت امیدوارم با استفاده کردن از مطالب وبسایت خرسند شده باشید.">
    <meta name="keywords" content="کد دیزاین, codedesign, آموزش PHp, jQuery, Vue.js, laravel framework">
@endsection
@section("content")
    <main class="container content-wrap">
        <h4>اطلاعات موتور</h4>
        <p>{{ $motor->name  }}نام موتور :  </p>
        <p>{{ $motor->model  }}مدل موتور :  </p>
        <p>{{ $motor->weight  }}وزن موتور :  </p>
        <p>{{ $motor->price  }}مبلغ موتور :  </p>
        <p>{{ $motor->cc  }}سیلندر موتور :  </p>
        <p><img src="{{ $motor->image  }}" />  </p>
    </main>
@endsection