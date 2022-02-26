<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('post_grad', 255)->default('-');
            $table->string('ch_equipe_name', 255)->default('-');
            $table->string('ch_equipe_pg', 255)->default('-');
            $table->string('data_assinatura', 255)->default('-');
            $table->string('om', 255)->default('-');
            $table->string('local_assinatura', 255)->default('-');
            $table->integer('userType')->default(2);
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
