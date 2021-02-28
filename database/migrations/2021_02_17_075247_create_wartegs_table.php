<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWartegsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wartegs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('owner_name');
            $table->text('address')->nullable();
            $table->string('phone', 20)->nullable();
            $table->text('description')->nullable();
            $table->string('photo_profile')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->boolean('is_approve')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wartegs');
    }
}
