<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformanceAssessmentsTable extends Migration
{
    public function up()
    {
        Schema::create('performance_assessments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('criteria_id');
            $table->string('subcriteria_code');
            $table->unsignedBigInteger('integrity_id')->nullable();
            $table->integer('subcriteria_standard_value');
            $table->integer('attribute_value');
            $table->integer('gap');
            $table->float('convertion_value')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('criteria_id')
                ->references('id')
                ->on('criterias')
                ->onDelete('cascade');

            $table->foreign('subcriteria_code')
                ->references('subcriteria_code')
                ->on('sub_criterias')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('performance_assessments');
    }
}
