<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('user_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('cell_number');
            $table->string('phone_number');
            $table->string('fax');
            $table->string('address');
            $table->string('website');
            $table->text('comment');
            $table->string('birth_date');
            $table->string('national_number');
            $table->string('id_number');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_meta');
    }
}
