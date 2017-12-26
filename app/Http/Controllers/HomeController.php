<?php

namespace App\Http\Controllers;

use App\Motorbike;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var Motorbike
     */
    private $motorbike;

    /**
     * HomeController constructor.
     * @param Request $request
     * @param Motorbike $motorbike
     */
    function __construct(Request $request, Motorbike $motorbike)
    {
        parent::__construct($request);
        $this->motorbike = $motorbike;
    }

    function getIndex(){

        $created_at = ($this->request->get("created_at") === null) ? 'ASC' : $this->request->get("created_at");
        $price = ($this->request->get("price") === null) ? 'ASC' : $this->request->get("price");

        $rows = $this->motorbike->orderBy("price", $price)->orderBy("created_at", $created_at)->paginate($this->row_per_page);
        return View("index", compact("rows"));
    }

    function getShow($id){

        $motor = $this->motorbike->whereId($id)->first();
        return View("motor_bike.show", compact("motor"));
    }
}
