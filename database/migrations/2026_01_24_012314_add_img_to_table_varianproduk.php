<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgToTableVarianproduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('varianproduk', function (Blueprint $table) {
            $table->text('img')->nullable();
            $table->text('dp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('varianproduk', function (Blueprint $table) {
            $table->dropColumn('img');
            $table->dropColumn('dp');
        });
    }
}
