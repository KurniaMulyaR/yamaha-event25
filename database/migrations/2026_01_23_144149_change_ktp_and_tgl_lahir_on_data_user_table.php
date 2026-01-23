<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeKtpAndTglLahirOnDataUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dataUser', function (Blueprint $table) {
            // $table->dropColumn('no_ktp_pembeli');            
            // $table->dropColumn('stnk_no_ktp');

            // $table->dropColumn('tanggal_lahir_pembeli');
            // $table->dropColumn('stnk_tanggal_lahir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dataUser', function (Blueprint $table) {
            // $table->string('no_ktp_pembeli', 16);            
            // $table->string('stnk_no_ktp', 16);

            // $table->text('tanggal_lahir_pembeli');
            // $table->text('stnk_tanggal_lahir');
        });
    }
}
