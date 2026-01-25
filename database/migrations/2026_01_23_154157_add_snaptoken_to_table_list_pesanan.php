<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSnaptokenToTableListPesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('list_pesanan', function (Blueprint $table) {
            // $table->text('snaptoken');
            // $table->text('orderid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('list_pesanan', function (Blueprint $table) {
            // $table->dropColumn('snaptoken');
            // $table->dropColumn('orderid');
        });
    }
}
