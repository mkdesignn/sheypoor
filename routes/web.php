<?php

use GuzzleHttp\Client;
use Illuminate\Http\Request;


Route::group(["middleware"=>"auth"], function(){

    Route::group(["middleware"=>"user:admin"], function(){

        Route::group(["prefix"=>"panel"], function(){

            // all routes goes here
            Route::get("log", "LogController@getIndex")->name("log");

            // factor routes
            Route::get("motor", "MotorController@getIndex")->name("motor.index");
            Route::get("motor/create", "MotorController@getCreate")->name("motor.create");
            Route::get("motor/edit/{id}", "MotorController@getEdit")->name("motor.edit");
            Route::post("motor/store", "MotorController@postStore")->name("motor.store");
            Route::post("motor/update/{id}", "MotorController@postUpdate")->name("motor.update");
            Route::get("motor/delete/{id}", "MotorController@getDelete")->name("motor.delete");


            // user routes
            Route::get("user", "UserController@getIndex")->name("user.index");
            Route::get("user/create", "UserController@getCreate")->name("user.create");
            Route::get("user/edit/{id}", "UserController@getEdit")->name("user.edit");
            Route::get("user/delete/{id}", "UserController@getDelete")->name("user.delete");
            Route::post("user/store", "UserController@postStore")->name("user.store");
            Route::post("user/update/{id}", "UserController@postUpdate")->name("user.update");


            Route::get("config", "ConfigController@getIndex")->name("config.index");
            Route::post("config", "ConfigController@postStore")->name("config.store");

        });

        Route::get("panel", "PanelController@getIndex")->name("panel.index");
    });
});

Route::get("/", "HomeController@getIndex");
Route::get("show/{id}", "HomeController@getShow");


Auth::routes();

