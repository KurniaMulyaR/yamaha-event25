<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJmlToTableVarianproduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('varianproduk', function (Blueprint $table) {
            $table->text('jmlunit');
            $table->text('price');
            $table->text('colour');
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
            $table->dropColumn('jmlunit'); 
            $table->dropColumn('price'); 
            $table->dropColumn('colour'); 
        });
    }
}
