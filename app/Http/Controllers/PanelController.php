<?php

namespace App\Http\Controllers;

use App\Meta;
use App\Post;
use Faker\Factory;
use HttpRequest;
use Illuminate\Http\Request;
use App\File;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Upload;
use App\Http\Controllers\Controller;

class PanelController extends Controller
{

    protected $file;
    protected $meta;
    protected $auth;
    protected $post;

    public function __construct(Request $request){

        parent::__construct( $request );
//        $this->file = $file;
//        $this->meta = $meta;
//        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {

        if( Auth::user()->type === "admin" )
            return View("admin.index.admin", compact("files"));
    }

    /**
     * Search the whole posts
     *
     * @return group collection
     */
    public function getSearch(){

       return $this->post->search($this->keyword)
           ->where("type", "post")
           ->get()->groupBy("type");
    }
}
