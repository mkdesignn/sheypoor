@extends("admin.master")
@section("content")
    {!! Breadcrumbs::render('user.index') !!}
    @include("admin.users.form", ["action"=>action('UserController@postUpdate', $user->id),
    "user"=>$user, "button"=>"ویرایش" , "type"=>"edit"])
@endsection