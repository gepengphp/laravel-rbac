<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaravelRbacMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rbac_menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->nullable(false)->common('父菜单ID');
            $table->integer('order')->nullable(false)->default(0)->common('排序');
            $table->string('title', 50)->nullable(false)->common('标题');
            $table->string('icon', 50)->nullable(false)->common('图标');
            $table->string('uri', 50)->nullable(true)->common('路径');
            $table->string('permission', 255)->nullable(true)->common('权限');
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
        Schema::dropIfExists('rbac_menu');
    }
}
