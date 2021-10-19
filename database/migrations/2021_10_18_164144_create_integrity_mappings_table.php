<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntegrityMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integrity_mappings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('criteria_id');
            $table->string('subcriteria_code');
            $table->integer('subcriteria_value');
            $table->integer('subcriteria_standard_value');
            $table->integer('integrity_mapping_value');
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('integrity_mappings');
    }
}
