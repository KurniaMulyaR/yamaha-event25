<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListDelear extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listDelear', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('code', 10)->unique();
            $table->char('district_code', 7);
            $table->text('namedds');
            $table->text('provinsi');
            $table->text('kota');
            $table->text('kecamatan');
            $table->text('namedelear');
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
        Schema::dropIfExists('listDelear');
    }
}
