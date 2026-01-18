<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDataUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataUser', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('userid', 4);

            // Identitas
            $table->string('nama_pembeli', 50);
            $table->string('no_ktp_pembeli', 12)->unique();

            // Lahir
            $table->string('tempat_lahir_pembeli', 50);
            $table->date('tanggal_lahir_pembeli');

            // Alamat
            $table->string('alamat_pembeli', 225);
            $table->string('provinsi', 50);
            $table->string('kota', 50);
            $table->string('kecamatan', 50);
            $table->string('kelurahan', 50);

            // Kontak
            $table->string('no_telepon_pembeli', 15)->nullable();
            $table->string('no_handphone_pembeli', 13);
            $table->string('email_pembeli', 225)->nullable();

            // Relasi pilihan
            $table->string('dealer', 100);
            $table->string('metode_pembayaran', 20);

            // STNK & BPKB - Identitas
            $table->string('stnk_nama_pemakai', 50);
            $table->string('stnk_no_ktp', 20);
            $table->string('stnk_tempat_lahir', 80);
            $table->date('stnk_tanggal_lahir');

            // STNK & BPKB - Alamat
            $table->text('stnk_alamat');
            $table->string('stnk_provinsi', 50);
            $table->string('stnk_kota', 50);
            $table->string('stnk_kecamatan', 50);
            $table->string('stnk_kelurahan', 50);

            // STNK & BPKB - Kontak
            $table->string('stnk_no_telepon', 15)->nullable();
            $table->string('stnk_no_handphone', 13)->nullable();
            $table->string('stnk_email', 100)->nullable();

            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dataUser');
    }
}
