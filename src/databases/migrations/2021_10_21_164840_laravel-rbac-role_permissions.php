<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaravelRbacRolePermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rbac_role_permissions', function (Blueprint $table) {
            $table->bigInteger('role_id')->nullable(false)->common('角色ID');
            $table->bigInteger('permission_id')->nullable(false)->common('权限ID');
            $table->timestamps();

            $table->unique([
                'role_id',
                'permission_id',
            ], 'admin_role_permissions_role_id_permission_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rbac_role_permissions');
    }
}
