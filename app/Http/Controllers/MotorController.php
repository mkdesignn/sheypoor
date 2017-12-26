<?php

namespace App\Http\Controllers;

use App\Motorbike;
use Illuminate\Http\Request;

class MotorController extends Controller
{

    /**
     * @var Motorbike
     */
    private $motorbike;

    /**
     * MotorController constructor.
     * @param Request $request
     * @param Motorbike $motorbike
     */
    function __construct(Request $request, Motorbike $motorbike)
    {
        parent::__construct($request);
        $this->motorbike = $motorbike;
    }

    function getIndex(){

        if( $this->request->ajax() )
            return $this->paginate($this->motorbike);
        else
            return View("admin.motor.index");
    }

    function getCreate(){

        return View("admin.motor.create", ["motor"=>$this->motorbike]);
    }

    function postStore(){

        $this->motorbike->create($this->getRequest());
        return redirect()->back()->with(["msg"=>"محصول شما با موفقیت ذخیره شد"]);
    }

    function getEdit($motor_id){

        return View("admin.motor.edit", ['motor'=>$this->motorbike->whereId($motor_id)->first()]);
    }

    function postUpdate($motor_id){


        $this->motorbike->whereId($motor_id)->update($this->getRequest());
        return redirect()->back()->with(["msg"=>"محصول شما با موفقیت ویرایش شد"]);

    }
    private function getRequest(){

        $this->validate($this->request, ["name"=>"required", "model"=>"required", "weight"=>"required", "color"=>"required"]);
        $request = $this->request->except(["_token"]);

        if( $this->request->hasFile('image') )
            $request["image"] = json_decode(\Upload::uploadFile($this->request, "image"))[0];

        return $request;
    }

    function getDelete($motor_id){

        $this->motorbike->whereId($motor_id)->delete();
        return redirect()->back()->with(["msg"=>"موتور مورد نظر با موفقیت حذف شد"]);
    }
}
