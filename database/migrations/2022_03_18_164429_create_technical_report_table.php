<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnicalReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technical_report', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_project');
            $table->unsignedBigInteger('id_ley');
            $table->string('observation');
            $table->integer('id_usuario');
            $table->timestamp('fecha_registro')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('status', 50);


            $table->foreign('id_project')->references('id')->on('projects');
            $table->foreign('id_ley')->references('id')->on('leyes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('technical_report');
    }
}
