<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use App\UserMeta;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use PhpParser\ErrorHandler\Collecting;

class UserController extends Controller
{

    protected $user;
    protected $userMeta;
    public function __construct(Request $request, User $user, UserMeta $userMeta)
    {
        parent::__construct($request);
        $this->user = $user;
        $this->userMeta = $userMeta;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
//        dd(json_encode(["id"=>"#", "name"=>"نام", "family"=>"", "email"=>"", "type"=>"", "sex"=>"", "status"=>"وضعیت"]), "salam");
        if( $this->request->ajax() ){
            $users = $this->user->search([["name"], ["family"], ['email']], $this->keyword);
            return $this->paginate($users);
        }else{
            return View("admin.users.index");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        $user = new Collection();
        return View("admin.users.create", compact("user"));
    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function postStore()
    {

        $this->validate($this->request, ["name"=>"required", "family"=>"required",
            "national_number"=>"required|unique:user_metas,national_number", "email"=>"unique:users,email"]);

        $user = $this->request->only(["name", "family", "email", "role_id", "sex"]);
        $user_meta = $this->request->only(["cell_number", "phone_number",
            "fax", "address", "comment", "website", "birth_date", "national_number", "id_number",
            "trade_code", "business_license", "trade_name"]);

        $user["username"] = $user_meta["national_number"];
        $password = generatePassPhrase($this->user);
        $user["password"] = Hash::make($password);
        $user = $this->user->create($user);
        $user_meta["user_id"] = $user->id;
        $this->userMeta->create($user_meta);

        return redirect()->back()->with(["msg"=>"پروفایل کاربر با موفقیت ایجاد شد .".
            " نام کاربری: ".$user["username"]." کلمه عبور: ".$password]);
    }

    /**
     * Update a post
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUpdate($user_id){


        // get the inputs
        $user = $this->request->only(["name", "family", "email", "role_id", "sex"]);
        $user_meta = $this->request->only(["cell_number", "phone_number",
            "fax", "address", "comment", "website", "birth_date", "national_number", "id_number"]);

        // update username and password
        $user["username"] = ($this->request->username === "") ? $this->request->national_number : $this->request->username;
        $user["password"] = ($this->request->password === "") ? Hash::make($this->request->national_number) : Hash::make($this->request->password);

        // update the models
        $user = $this->user->whereId($user_id)->update($user);
        $this->userMeta->whereUserId($user_id)->update($user_meta);

        return redirect()->back()->with(["msg"=>"پروفایل کاربر با موفقیت ایجاد شد ."]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id){
        $user = $this->user->whereId($id)->first();
        return View("admin.users.edit", compact("user"));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegisteredUsers(){
        return View("admin.users.registered");
    }

    /**
     * @param $id
     * @return string
     */
    public function getDelete($id){
        $this->user->whereId($id)->delete();
        return 'true';
    }
}
