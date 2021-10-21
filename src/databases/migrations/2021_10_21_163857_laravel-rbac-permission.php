<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaravelRbacPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rbac_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50)->nullable(false)->common('名称');
            $table->string('slug', 50)->nullable(false)->common('标识');
            $table->string('http_method', 255)->nullable(true)->common('方法');
            $table->text('http_path')->nullable(true)->common('路径');
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
        Schema::dropIfExists('rbac_permissions');
    }
}
