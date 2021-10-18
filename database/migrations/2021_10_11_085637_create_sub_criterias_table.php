<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCriteriasTable extends Migration
{
    public function up()
    {
        Schema::create('sub_criterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criteria_id');
            $table->string('subcriteria_code')->unique();
            $table->string('name');
            $table->integer('standard_value');
            $table->timestamps();

            $table->foreign('criteria_id')
            ->references('id')
            ->on('criterias')
            ->onDelete('cascade');
        });


    }

    public function down()
    {
        Schema::dropIfExists('sub_criterias');
    }
}
