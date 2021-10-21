<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaravelRbacRoleMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rbac_role_menu', function (Blueprint $table) {
            $table->biginteger('role_id')->nullable(false)->common('角色ID');
            $table->bigInteger('menu_id')->nullable(false)->common('菜单ID');
            $table->timestamps();

            $table->unique([
                'role_id',
                'menu_id',
            ], 'admin_role_menu_role_id_menu_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rbac_role_menu');
    }
}
