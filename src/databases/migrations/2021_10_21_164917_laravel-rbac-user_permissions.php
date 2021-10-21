<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaravelRbacUserPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rbac_user_permissions', function (Blueprint $table) {
            $table->bigInteger('user_id')->nullable(false)->common('用户ID');
            $table->bigInteger('permission_id')->nullable(false)->common('权限ID');
            $table->timestamps();

            $table->unique([
                'user_id',
                'permission_id',
            ], 'admin_user_permissions_user_id_permission_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rbac_user_permissions');
    }
}
