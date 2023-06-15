<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutasi', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_surat');
            $table->string('nomor');
            $table->string('jml_lampiran');
            $table->string('perihal');
            $table->string('camat');
            $table->string('tgl_musyawarah');
            $table->string('perangkat_desa');
            $table->string('kepala_desa');
            $table->string('jabatan_lama');
            $table->string('jabatan_baru');
            $table->text('lampiran');
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
        Schema::dropIfExists('mutasi');
    }
};
