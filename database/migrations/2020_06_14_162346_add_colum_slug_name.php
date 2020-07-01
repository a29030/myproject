<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumSlugName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_news', function (Blueprint $table) {
            $table->string('slug_name');
        });
        Schema::table('category_product', function (Blueprint $table) {
            $table->string('slug_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_news', function (Blueprint $table) {
            $table->dropColumn('slug_name');
        });
        Schema::table('category_product', function (Blueprint $table) {
            $table->dropColumn('slug_name');
        });
    }
}
