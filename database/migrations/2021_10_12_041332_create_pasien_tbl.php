<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasienTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->string('no_lab');
            $table->string('no_rm');
            $table->string('nama');
            $table->string('nama_dok');
            $table->string('jns_kelamin');
            $table->string('umur');
            $table->date('tgl_lahir');
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('lokasi');
            $table->date('tgl_tes');
            $table->string('igm');
            $table->string('igg');
            $table->string('metode');
            $table->string('k_satu');
            $table->string('k_dua');
            $table->string('k_tiga');
            $table->string('k_empat');
            $table->string('screening');
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
        Schema::dropIfExists('pasien');
    }
}
