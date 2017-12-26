@extends("admin.master")
@section("content")
    @include("admin.motor.form", ['form_title'=>"ویرایش موتور",
     "button"=>"ویرایش", 'url'=>url()->action("MotorController@postUpdate", [$motor->id]),
      "motor"=>$motor])
@endsection