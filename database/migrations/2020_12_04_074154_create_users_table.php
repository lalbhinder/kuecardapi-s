<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('email',191)->unique;
            $table->string('password',191)->nullable();
            $table->string('user_code',191)->nullable();
            $table->string('user_role',191)->nullable();
            $table->string('first_name',191)->nullable();
            $table->string('last_name',191)->nullable();
            $table->string('title',191)->nullable();
            $table->string('phone_no',191)->nullable();
            $table->string('user_image',191)->nullable();
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
        Schema::dropIfExists('users');
    }
}
