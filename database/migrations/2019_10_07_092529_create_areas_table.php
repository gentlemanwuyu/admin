<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->default('')->comment('地区编号');
            $table->string('name')->default('')->comment('名称');
            $table->tinyInteger('level')->default(0)->comment('层级');
            $table->string('city_code')->default('')->comment('区号');
            $table->string('center')->default('')->comment('中心经纬度');
            $table->integer('parent_id')->default(0)->comment('父级地区ID');
            $table->unique('code');
            $table->index('name');
            $table->index('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
