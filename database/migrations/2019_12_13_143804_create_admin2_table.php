<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmin2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin2', function (Blueprint $table) {
            $table->bigIncrements('adm2_id');
            $table->string('name');
            $table->bigInteger('adm1_id')->unsigned();
            $table->foreign('adm1_id')->references('adm1_id')->on('admin1');
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
        Schema::dropIfExists('admin2');
    }
}
