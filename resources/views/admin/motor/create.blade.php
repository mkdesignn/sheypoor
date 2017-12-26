@extends("admin.master")
@section("content")
    @include("admin.motor.form", ['form_title'=>"ایجاد موتور",
     "button"=>"ایجاد", 'url'=>url()->action("MotorController@postStore"), "motor"=>$motor])
@endsection