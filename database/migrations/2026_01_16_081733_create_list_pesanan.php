<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListPesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_pesanan', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('userid');
            $table->char('produkid');
            $table->char('delearid');
            $table->char('status');
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('list_pesanan');
    }
}
