<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaravelRbacOperationLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rbac_operation_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable(false)->common('用户ID')->index('admin_operation_log_user_id_index');
            $table->string('path', 255)->nullable(false);
            $table->string('method', 10)->nullable(false);
            $table->string('ip', 255)->nullable(false);
            $table->text('input', 255)->nullable(false);
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
        Schema::dropIfExists('rbac_operation_log');
    }
}
