<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $request;
    protected $row_per_page;
    protected $page;
    protected $keyword;
    protected $auth;
    protected $admin;

    public function __construct(Request $request){

        $this->middleware(function ($request, $next) {
            $this->auth = Auth::user();
            return $next($request);
        });

        $this->request = $request;
        if( $this->request->has("row_per_page") ){
            if( $this->request->get("row_per_page") == "-1" )
                $this->row_per_page = 99999999;
            else
                $this->row_per_page = $this->request->get("row_per_page");
        }
        else
            $this->row_per_page = 12;

        if( $this->request->get("page") )
            $this->page = $this->request->get("page");
        else
            $this->page = 1;

        if( $this->request->has("search") )
            $this->keyword = $this->request->get("search");
        else
            $this->keyword = null;

        $this->admin = User::where("role_id", 6)->first();
    }

    /**
     * Using this method to generate the appropriate paginate
     *
     * @param $query
     * @return string
     */
    protected function paginate($query){

        $paginate = $query->paginate($this->row_per_page, null, null, $this->page);
        return [$paginate->toArray(), $paginate->render()->toHtml()];
    }
}
