<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelurahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelurahans', function (Blueprint $table) {
            $table->char('id',10);
            $table->primary('id');
            $table->char('id_kecamatan');
            $table->string('nama_kelurahan', 30);
            $table->timestamps();

            $table->foreign('id_kecamatan')
                ->references('id')
                ->on('kecamatans')
                ->onUpdate('cascade')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelurahans');
    }
}
