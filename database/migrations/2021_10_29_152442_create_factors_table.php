<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('criteria_id');
            $table->unsignedBigInteger('user_id');
            $table->float('core_factor_value')->nullable();
            $table->float('secondary_factor_value')->nullable();
            $table->float('total_value')->nullable();
            $table->timestamps();

            $table->foreign('criteria_id')
                ->references('id')
                ->on('criterias')
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
        Schema::dropIfExists('factors');
    }
}
