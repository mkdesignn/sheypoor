<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShowMoreInfo()
    {
        $this->visit("/")
            ->see("table")
            ->seeLink("نمایش")
            ->click('نمایش')
            ->see('اطلاعات موتور');
    }

    function testPagination(){

        $this->visit("/")
            ->see("pagination")
            ->visit("http://localhost:8000?page=1")
            ->seePageIs(url()->to('/').'/?page=1');
    }

    function testOrderByCreatedAt(){

    }

    function testOrderByPrice(){

    }
}
