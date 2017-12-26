<?php
$viewed =  \Illuminate\Support\Facades\Request::get("viewed");
$status =  \Illuminate\Support\Facades\Request::get("status");

Breadcrumbs::register('panel.index', function($breadcrumbs) {
    $breadcrumbs->push('خانه', route('panel.index'));
});

Breadcrumbs::register('user.index', function($breadcrumbs) {
    $breadcrumbs->parent('panel.index');
    $breadcrumbs->push('لیست کاربران', route('user.index'));
});

Breadcrumbs::register('user.create', function($breadcrumbs) {
    $breadcrumbs->parent('panel.index');
    $breadcrumbs->push('ایجاد کاربر', route('user.create'));
});

Breadcrumbs::register('user.edit', function($breadcrumbs) {
    $breadcrumbs->parent('panel.index');
    $breadcrumbs->push('ویرایش کاربر', route('user.edit'));
});

Breadcrumbs::register('motor', function($breadcrumbs) {
    $breadcrumbs->parent('panel.index');
    $breadcrumbs->push('لیست موتورها', route('motor.index'));
});

//Breadcrumbs::register('user.registered', function($breadcrumbs) {
//    $breadcrumbs->parent('panel.index');
//    $breadcrumbs->push(' کاربران ثبت نامی ', route('user.registered'));
//});


Breadcrumbs::register('motor.create', function($breadcrumbs) {
    $breadcrumbs->parent('panel.index');

    $links = "<a class='helper_links' data-toggle='tooltip' data-placement='bottom' ".
    "data-original-title='بازگشت'  href='".URL::previous()."'><span class='icomoon-uniE030'>
    </span></a><a style='font-size: smaller;padding: 20px;' class='helper_links'
    href='".route('motor.index')."'><span>لیست فاکتورها</span></a>";

    $breadcrumbs->push('ایجاد فاکتور', route('motor.create'), ["links"=>$links]);
});

Breadcrumbs::register('motor.index', function($breadcrumbs) {
    $breadcrumbs->parent('panel.index');

    $links = "<a class='helper_links' data-toggle='tooltip' data-placement='bottom' ".
        "data-original-title='بازگشت'  href='".URL::previous()."'><span class='icomoon-uniE030'>
    </span></a><a style='font-size: smaller;padding: 20px;' class='helper_links'
    href='".route('motor.create')."'><span>ایجاد فاکتور</span></a>";

    $breadcrumbs->push('لیست فاکتورها', route('motor.index'), ["links"=>$links]);
});

Breadcrumbs::register('formula.index', function($breadcrumbs) {
    $breadcrumbs->parent('panel.index');

    $links = "<a class='helper_links' data-toggle='tooltip' data-placement='bottom' ".
        "data-original-title='بازگشت'  href='".URL::previous()."'><span class='icomoon-uniE030'>
    </span></a><a style='font-size: smaller;padding: 20px;' class='helper_links'
    href='".route('formula.create')."'><span>ایجاد فرمول</span></a>";

    $breadcrumbs->push('لیست فرمولها', route('formula.index'), ["links"=>$links]);
});

Breadcrumbs::register('formula.create', function($breadcrumbs) {
    $breadcrumbs->parent('panel.index');

    $links = "<a class='helper_links' data-toggle='tooltip' data-placement='bottom' ".
        "data-original-title='بازگشت'  href='".URL::previous()."'><span class='icomoon-uniE030'>
    </span></a><a style='font-size: smaller;padding: 20px;' class='helper_links'
    href='".route('formula.index')."'><span>لیست فرمولها</span></a>";

    $breadcrumbs->push('ایجاد فرمول', route('formula.create'), ["links"=>$links]);
});

Breadcrumbs::register('agent.create', function($breadcrumbs) {
    $breadcrumbs->parent('panel.index');

    $links = "<a class='helper_links' data-toggle='tooltip' data-placement='bottom' ".
        "data-original-title='بازگشت'  href='".URL::previous()."'><span class='icomoon-uniE030'>
    </span></a><a style='font-size: smaller;padding: 20px;' class='helper_links'
    href='".route('agent.index')."'><span>لیست فرمولها</span></a>";

    $breadcrumbs->push('ایجاد فرمول', route('agent.create'), ["links"=>$links]);
});

Breadcrumbs::register('agent.index', function($breadcrumbs) {
    $breadcrumbs->parent('panel.index');

    $links = "<a class='helper_links' data-toggle='tooltip' data-placement='bottom' ".
        "data-original-title='بازگشت'  href='".URL::previous()."'><span class='icomoon-uniE030'>
    </span></a><a style='font-size: smaller;padding: 20px;' class='helper_links'
    href='".route('agent.create')."'><span>ایجاد آزانس</span></a>";

    $breadcrumbs->push('لیست نمایندگی ها', route('agent.index'), ["links"=>$links]);
});

Breadcrumbs::register('motor.articles', function($breadcrumbs, $invoice_article_id) {
    $breadcrumbs->parent('motor.index');

    $links = "<a class='helper_links' data-toggle='tooltip' data-placement='bottom' ".
        "data-original-title='بازگشت'  href='".URL::previous()."'><span class='icomoon-uniE030'>
    </span></a><a style='font-size: smaller;padding: 20px;' class='helper_links'
    href='".route('motor.create')."'><span>ایجاد فاکتور</span></a><a style='font-size: smaller;padding: 20px;' class='helper_links'
    href='".route('motor.index')."'><span>لیست فاکتورها</span></a>";

    $breadcrumbs->push('لیست اقلام فاکتور', route('motor.articles', $invoice_article_id), ["links"=>$links]);
});

Breadcrumbs::register('product.index', function($breadcrumbs) {
    $breadcrumbs->parent('panel.index');
    $breadcrumbs->push('لیست کالا', route('product.index'));
});



//Breadcrumbs::register('post.create', function($breadcrumbs) {
//    $breadcrumbs->parent('panel.index');
//    $breadcrumbs->push('ایجاد خبر', route('post.create'));
//});
//
//Breadcrumbs::register('post.edit', function($breadcrumbs) {
//    $breadcrumbs->parent('panel.index');
//    $breadcrumbs->push('ویرایش خبر', route('post.create'));
//});
//
//Breadcrumbs::register('log.index', function($breadcrumbs) {
//    $breadcrumbs->parent('panel.index');
//    $breadcrumbs->push('لاگ', route('log.index'));
//});

//Breadcrumbs::register('post.index', function($breadcrumbs) use ($status) {
//
//    $breadcrumbs->parent('panel.index');
//    $title = "";
//    $links = "";
//
//    if ($status == "deleted"){
//        $links = "<a class='helper_links' data-toggle='tooltip' data-placement='bottom'
//            data-original-title='بازگشت'  href='".URL::previous()."'><span class='icomoon-uniE030'>
//            </span></a><a style='font-size: smaller;padding: 20px;' class='helper_links'
//            href='".route('post.create')."'><span>ایجاد خبر</span></a>
//            <a style='font-size: smaller;padding: 20px;' class='helper_links'".
//            "href='".route('post.index')."?status=active'>".
//            "<span>لیست خبر</span></a>";
//        $title = "لیست اخبار حذف شده";
//    } elseif ($status == "active") {
//        $links = "<a class='helper_links' data-toggle='tooltip' data-placement='bottom' ".
//            "data-original-title='بازگشت'  href='".URL::previous()."'><span class='icomoon-uniE030'>
//            </span></a><a style='font-size: smaller;padding: 20px;' class='helper_links'
//            href='".route('post.create')."'><span>ایجاد خبر</span></a><a style='font-size: smaller;padding: 20px;' class='helper_links'".
//            "href='".route('post.index')."?status=deleted'>".
//            "<span>خبرهای حذف شده</span></a>";
//        $title = "لیست اخبار";
//    }
//
//    $breadcrumbs->push($title, route('post.index'), ["links"=>$links]);
//});


//Breadcrumbs::register('post.head-line', function($breadcrumbs) {
//    $breadcrumbs->parent('panel.index');
//    $breadcrumbs->push('سر خط خبرها', route('post.head-line'));
//});

//Breadcrumbs::register('gallery.index', function($breadcrumbs) {
//    $breadcrumbs->parent('panel.index');
//    $breadcrumbs->push('لیست فایلها', route('gallery.index'));
//});

//Breadcrumbs::register('gallery.upload', function($breadcrumbs) {
//    $breadcrumbs->parent('panel.index');
//    $breadcrumbs->push('آپلود فایل', route('gallery.upload'));
//});

//Breadcrumbs::register('gallery.slider', function($breadcrumbs) {
//    $breadcrumbs->parent('panel.index');
//    $breadcrumbs->push('اسلایدر', route('gallery.slider'));
//});



//Breadcrumbs::register('commission.create', function($breadcrumbs) {
//    $breadcrumbs->parent('panel.index');
//    $breadcrumbs->push(' ایجاد کمیسیون ', route('commission.create'));
//});

//Breadcrumbs::register('commission.edit', function($breadcrumbs) {
//    $breadcrumbs->parent('panel.index');
//    $breadcrumbs->push(' ویرایش کمیسیون ', route('commission.edit'));
//});


//Breadcrumbs::register('commission.index', function($breadcrumbs) {
//    $breadcrumbs->parent('panel.index');
//    $breadcrumbs->push(' لیست کمیسیون ', route('commission.index'));
//});

//Breadcrumbs::register('contact-us.show', function($breadcrumbs) {
//    $breadcrumbs->parent('panel.index');
//    $breadcrumbs->push('نمایش پیام', route('contact-us.show'));
//});

//Breadcrumbs::register('case.index', function($breadcrumbs) {
//    $query_string = \Illuminate\Support\Facades\Request::getQueryString();
//    $breadcrumbs->parent('panel.index');
//    if( $query_string == "formed" )
//        $query_string = "تشکیل شده";
//    else
//        $query_string = "در دست اقدام";
//
//    $breadcrumbs->push('لیست پرونده ها / '.$query_string, route('case.index'));
//});

Breadcrumbs::register('/', function($breadcrumbs) {
    $breadcrumbs->push(' ', route('/'), ["icon"=>"fa fa-home"]);
});




//Breadcrumbs::register('history', function($breadcrumbs) {
//    $breadcrumbs->parent('/');
//    $breadcrumbs->push(' درباره اتحادیه &nbsp; / &nbsp; تاریخچه ', route('history'));
//});

//Breadcrumbs::register('director-board', function($breadcrumbs) {
//    $breadcrumbs->parent('/');
//    $breadcrumbs->push(' درباره اتحادیه &nbsp; / &nbsp; هیئت مدیره ', route('director-board'));
//});

//Breadcrumbs::register('commission', function($breadcrumbs) {
//    $breadcrumbs->parent('/');
//    $breadcrumbs->push(' درباره اتحادیه &nbsp; / &nbsp; هیئت مدیره ', route('commission'));
//});

//Breadcrumbs::register('rules', function($breadcrumbs) {
//    $breadcrumbs->parent('/');
//    $breadcrumbs->push(' قوانین و مقررات &nbsp; ', route('rules'));
//});

//Breadcrumbs::register('rule.index', function($breadcrumbs) {
//    $breadcrumbs->parent('/');
//    $breadcrumbs->push('قوانین و مقررات', route('rule.index'));
//});

//Breadcrumbs::register('auth.login', function($breadcrumbs) {
//    $breadcrumbs->parent('/');
//    $breadcrumbs->push(' ورود ', route('auth.login'));
//});

//Breadcrumbs::register('auth.register', function($breadcrumbs) {
//    $breadcrumbs->parent('/');
//    $breadcrumbs->push(' ثبت نام ', route('auth.register'));
//});



//Breadcrumbs::register('news', function($breadcrumbs) {
//    $breadcrumbs->parent('/');
//    $breadcrumbs->push(' خبر ', route('news'));
//});



//Breadcrumbs::register('stolen-goods', function($breadcrumbs) {
//    $breadcrumbs->parent('/');
//    $breadcrumbs->push(' محصولات سرقتی ', route('stolen-goods'));
//});

//Breadcrumbs::register('search-goods', function($breadcrumbs) {
//    $breadcrumbs->parent('stolen-goods');
//    $breadcrumbs->push(' جستجوی محصولات ', route('search-goods'));
//});

//Breadcrumbs::register('addStolenGoods', function($breadcrumbs) {
//    $breadcrumbs->parent('stolen-goods');
//    $breadcrumbs->push(' ذخیره کردن محصولات ', route('addStolenGoods'));
//});

//Breadcrumbs::register('goods.index', function($breadcrumbs) {
//    $breadcrumbs->parent('panel.index');
//    $breadcrumbs->push(' محصولات به سرقت رفته ', route('goods.index'));
//});

//Breadcrumbs::register('contact-us', function($breadcrumbs) {
//    $breadcrumbs->parent('/');
//    $links = "<a class='helper_links' data-toggle='tooltip' data-placement='bottom'
//    data-original-title='بازگشت'  href='".URL::previous()."'><span class='icomoon-uniE030'>
//    </span></a>";
//    $breadcrumbs->push(' لیست پیامهای دریافتی ', route('contact-us'), ["links"=>$links]);
//});

//Breadcrumbs::register('comment.index', function($breadcrumbs) use ($status) {
//    $breadcrumbs->parent('panel.index');
//    $links = "<a class='helper_links' data-toggle='tooltip' data-placement='bottom'
//    data-original-title='بازگشت'  href='".URL::previous()."'><span class='icomoon-uniE030'>
//    </span></a>";
//
//    $message = "";
//    if( $status == "viewed" ){
//        $message = "نظرهای خوانده شده";
//        $links .= "<a style='font-size: smaller;padding: 20px;' class='helper_links'
//        href='".action('CommentController@getIndex')."?status=not-viewed'><span>نظرهای خوانده نشده</span></a>";
//        $links .= "<a style='font-size: smaller;padding: 20px;' class='helper_links'
//        href='".action('CommentController@getIndex')."?status=deleted'><span>نظرهای حذف شده</span></a>";
//    } elseif ($status == "not-viewed") {
//        $message = "نظرهای خوانده نشده";
//        $links .= "<a style='font-size: smaller;padding: 20px;' class='helper_links'
//        href='".action('CommentController@getIndex')."?status=viewed'><span>نظرهای خوانده شده</span></a>";
//        $links .= "<a style='font-size: smaller;padding: 20px;' class='helper_links'
//        href='".action('CommentController@getIndex')."?status=deleted'><span>نظرهای حذف شده</span></a>";
//    } elseif ($status == "deleted") {
//        $message = "نظرهای حذف شده ";
//        $links .= "<a style='font-size: smaller;padding: 20px;' class='helper_links'
//        href='".action('CommentController@getIndex')."?status=viewed'><span>نظرهای خوانده شده</span></a>";
//        $links .= "<a style='font-size: smaller;padding: 20px;' class='helper_links'
//        href='".action('CommentController@getIndex')."?status=not-viewed'><span>نظرهای خوانده نشده</span></a>";
//    } elseif ( $status == 'grouped' ) {
//        $post_id =  \Illuminate\Support\Facades\Request::get("post_id");
//        $links .= "نظرهای پست ".\App\Post::whereId($post_id)->first()->title;
//    }
//    $breadcrumbs->push($message, route('comment.index'), ["links"=>$links]);
//});
//
//Breadcrumbs::register('member.index', function($breadcrumbs) use ($status) {
//
//    $message = "";
//    $breadcrumbs->parent('panel.index');
//    $links = "<a class='helper_links' data-toggle='tooltip' data-placement='bottom'
//    data-original-title='بازگشت'  href='".URL::previous()."'><span class='icomoon-uniE030'>
//    </span></a>";
//
//    if ($status == "deleted") {
//        $links .= "<a style='font-size: smaller;padding: 20px;' class='helper_links'
//        href='".action('MemberController@getIndex')."?status=all'>
//        <span>لیست اعضاء</span></a>";
//        $message = "لیست اعضاء حذف شده ";
//    } else {
//        $links .= "<a style='font-size: smaller;padding: 20px;' class='helper_links'
//        href='".action('MemberController@getIndex')."?status=deleted'>
//        <span>لیست اعضاء حذف شده</span></a>";
//        $message = "لیست اعضاء";
//    }
//
//    $breadcrumbs->push($message, route('member.index'), ["links"=>$links]);
//});
//
//Breadcrumbs::register('config.index', function($breadcrumbs) {
//    $breadcrumbs->parent('/');
//    $links = "<a class='helper_links' data-toggle='tooltip' data-placement='bottom'
//    data-original-title='بازگشت'  href='".URL::previous()."'><span class='icomoon-uniE030'>
//    </span></a>";
//    $breadcrumbs->push(' تنضیمات اولیه ', route('config.index'), ["links"=>$links]);
//});