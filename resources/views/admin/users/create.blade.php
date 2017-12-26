@extends("admin.master")
@section("content")
    {!! Breadcrumbs::render('user.create') !!}
    @include("admin.users.form", ["action"=>action('UserController@postStore'),
    "user"=>$user, "button"=>"ذخیره", "id"=>"", "type"=>"edit"])
@endsection