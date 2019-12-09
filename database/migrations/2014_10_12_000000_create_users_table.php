<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    // /**
    //  * Run the migrations.
    //  *
    //  * @return void
    //  */
    // public function up()
    // {
    //     Schema::create('users', function (Blueprint $table) {
    //         $table->bigIncrements('id')->unsigned();
    //         $table->string('name');
    //         $table->string('password');
    //         $table->string('email')->unique();
    //         $table->enum('User_profile', ['User', 'Administrator','Evaluator'])->default('User');
    //         $table->timestamp('Start_date')->useCurrent = true;
    //         $table->timestamp('Date_operation')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
    //         $table->enum('Operation', ['A', 'U','D'])->default('A');
    //         $table->float('version')->default('1');
    //         $table->timestamp('email_verified_at')->nullable();
    //         $table->rememberToken();
    //         $table->timestamps();
    //     });
    //     DB::statement("ALTER TABLE users AUTO_INCREMENT = 1400000000;");
    // }

    // /**
    //  * Reverse the migrations.
    //  *
    //  * @return void
    //  */
    // public function down()
    // {
    //     Schema::dropIfExists('users');
    // }
}
