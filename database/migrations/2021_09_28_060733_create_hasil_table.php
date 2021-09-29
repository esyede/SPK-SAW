<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kriteria_id')->unsigned()->index();
            $table->bigInteger('barang_id')->unsigned()->index();
            // $table->foreignId('kriteria_id')->constrained('criterias');
            // $table->foreignId('barang_id')->constrained('barang');
            $table->float('nilai')->unsigned()->nullable();
            $table->timestamps();

            // $table->foreign('kriteria_id')
            //     ->references('id')
            //     ->on('criterias')
            //     ->onUpdate('cascade');

            // $table->foreign('barang_id')
            //     ->references('id')
            //     ->on('barang')
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasil');
    }
}
