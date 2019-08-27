<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVipUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vip_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('permissions_inheritance_id');
            $table->foreign('permissions_inheritance_id')
                    ->references('id')
                    ->on('permissions_inheritance')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');
            $table->boolean('is_vip');
            $table->date('expiration_date');
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
        Schema::dropIfExists('vip_users');
    }
}
