<?php
namespace App\ThemeDependencies;

/**
 * Created by PhpStorm.
 * User: mohammad kaab
 * Date: 9/26/2017
 * Time: 10:12 PM
 */
class Seed
{
    /**
     * @var Status
     */
    private $status;
    /**
     * @var Role
     */
    private $role;

    /**
     */
    function __construct(){

    }

    /**
     * fill the status table
     */
    function makeStatus(){

        $statuses = ['active'=>'فعال',
        'inactive'=>'غیر فعال',
        'suspend'=>'معلق',
        'done'=>'انجام شده',
        'finished'=>'پایان یافته',
        'in-progress'=>'در حال انجام',
        'formed'=>'تشکیل شده',
        'confirm'=>'تایید',
        'not-confirm'=>'تایید نشده',
        'pending-approval' => 'در انتظار تایید',
        'draft'=>'پیش نویس',
        'trash'=>'زباله دان',
        'pending'=>'در انتظار تایید'
        ];
        $status = "App\\Status";
        $this->status = new $status();
        foreach($statuses as $key => $status){
            $this->status->create(["name"=>$key, "value"=>$status]);
        }


    }

    /**
     * fill the roll table
     */
    function makeRole(){

        $roles = [ "super-admin" => ["ادمین کل", 'سوپر ادمین'],
                   'admin'=>        ['ادمین', 'ادمنی سیستم '],
                   'editor'=>       ['ویراستار', 'ویرایش کننده مطالب'],
                   'writer'=>       ['نویسنده', 'نویسنده مطالب']
                 ];

        $role = "App\\Role";
        $this->role = new $role();
        foreach($roles as $key => $role){
            $this->role->create(["name"=>$key, "value"=>$role[0], "comment"=>$role[1]]);
        }


    }

}