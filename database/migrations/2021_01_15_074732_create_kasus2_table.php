<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasus2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kasus2s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_rw')->constrained('rws')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('jpositif');
            $table->integer('jsembuh');
            $table->integer('jmeninggal');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kasus2s');
    }
}
