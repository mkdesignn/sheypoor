<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MotorTest extends PHPUnit_Util_Test
{

    protected $motor;

    function setUp(){
        $this->motor = new \App\Motorbike(["model"=>"B234", "color"=>"#282949", "name"=> "Honda", "price"=>"232323"]);
    }

    function testAMotorHasAName(){
        $this->assertEquals("B234", $this->motor->model);
    }
}
