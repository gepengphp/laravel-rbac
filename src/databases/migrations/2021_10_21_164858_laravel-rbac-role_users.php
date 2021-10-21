<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaravelRbacRoleUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rbac_role_users', function (Blueprint $table) {
            $table->bigInteger('role_id')->nullable(false)->common('角色ID');
            $table->bigInteger('user_id')->nullable(false)->common('用户ID');
            $table->timestamps();

            $table->unique([
                'role_id',
                'user_id',
            ], 'admin_role_users_role_id_user_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rbac_role_users');
    }
}
