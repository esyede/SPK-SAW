<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvertionIntegrityMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convertion_integrity_mappings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('criteria_id');
            $table->unsignedBigInteger('user_id');
            $table->string('subcriteria_code');
            $table->unsignedBigInteger('integrity_id');
            $table->unsignedBigInteger('integrity_mapping_id');
            $table->integer('integrity_mapping_value');
            $table->integer('convertion_value');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('criteria_id')
                ->references('id')
                ->on('criterias')
                ->onDelete('cascade');

            $table->foreign('subcriteria_code')
                ->references('subcriteria_code')
                ->on('sub_criterias')
                ->onDelete('cascade');

            $table->foreign('integrity_id')
                ->references('id')
                ->on('integrities')
                ->onDelete('cascade');

            $table->foreign('integrity_mapping_id')
                ->references('id')
                ->on('integrity_mappings')
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
        Schema::dropIfExists('convertion_integrity_mappings');
    }
}
