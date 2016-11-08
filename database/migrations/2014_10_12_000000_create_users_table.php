<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('surname');
            $table->string('thumbnail');
            $table->string('phone')->default('');
            $table->string('address')->default('');
            $table->string('city')->default('');
            $table->string('country')->default('');
            $table->string('email')->unique();
            $table->text('permissions');
            $table->string('password');
            $table->string('activation_hash')->default('');
            $table->boolean('is_active')->default(0);
            $table->boolean('is_admin')->default(0);
            $table->rememberToken();
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
