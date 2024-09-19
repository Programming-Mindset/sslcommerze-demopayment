<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemoDemoPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demo_demo', function (Blueprint $table) {
            $table->integer('demo_id')->unsigned()->index();
            $table->foreign('demo_id')->references('id')->on('demos')->onDelete('cascade');
            $table->integer('demo_id')->unsigned()->index();
            $table->foreign('demo_id')->references('id')->on('demos')->onDelete('cascade');
            $table->primary(['demo_id', 'demo_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('demo_demo');
    }
}