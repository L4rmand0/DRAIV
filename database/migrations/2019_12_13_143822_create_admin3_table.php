<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmin3Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin3', function (Blueprint $table) {
            $table->bigIncrements('adm3_id');
            $table->string('name');
            $table->bigInteger('adm2_id')->unsigned();
            $table->foreign('adm2_id')->references('adm2_id')->on('admin2');
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
        Schema::dropIfExists('admin3');
    }
}
