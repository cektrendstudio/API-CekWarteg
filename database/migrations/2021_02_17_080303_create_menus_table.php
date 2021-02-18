<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('warteg_id');
            $table->unsignedInteger('price');
            $table->boolean('is_have_stock');
            $table->string('photo');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('warteg_id')
                ->references('id')
                ->on('wartegs')
                ->onDelete('no action')
                ->onUpdate('cascade');


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
        Schema::dropIfExists('menus');
    }
}
