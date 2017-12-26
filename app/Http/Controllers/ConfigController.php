<?php

namespace App\Http\Controllers;

use App\Meta;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * @var Meta
     */
    private $meta;

    /**
     * @param Request $request
     * @param Meta $meta
     */
    function __construct(Request $request, Meta $meta){

        parent::__construct($request);

        $this->meta = $meta;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex(){

        $meta = $this->meta->whereMetaPrefix("config")->get()->map(function($meta){
            return [ $meta->meta_key => $meta->meta_value ];
        })->toArray();

        return View("admin.config.index", ...$meta);
    }

    /**
     * store the config
     */
    public function postStore(){

        foreach ($this->request->except(["_token"]) as $key => $input) {
            if ($this->meta->whereMetaPrefix("config")->whereMetaKey($key)->exists()) {
                $this->meta->whereMetaPrefix("config")->whereMetaKey($key)->update(["meta_value"=>$input]);
            } else {
                $this->meta->create(["meta_prefix"=>"config", "meta_key"=>$key, "meta_value"=>$input]);
            }
        }

        return redirect()->back()->with(["success"=>"??????? ?? ?????? ???? ???? ???? ."]);
    }
}
