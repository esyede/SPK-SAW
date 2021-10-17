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
            $table->string('sub_criteria_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_criterias');
    }
}
