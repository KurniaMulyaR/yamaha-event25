<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCbudealerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cbudealer', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('code');
            $table->text('district_code');
            $table->text('namedds');
            $table->text('provinsi');
            $table->text('kota');
            $table->text('kecamatan');
            $table->text('namedelear');
            $table->text('code_kota');
            $table->text('cansell');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cbudealer');
    }
}
