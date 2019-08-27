<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateVipUsersTableAddUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vip_users', function (Blueprint $table) {
            $table->mediumInteger('user_id')->unsigned()->after('id');
            $table->foreign('user_id')
                ->references('id')
                ->on('authme')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vip_users', function (Blueprint $table) {
            $table->dropColumn(['user_id']);
        });
    }
}
