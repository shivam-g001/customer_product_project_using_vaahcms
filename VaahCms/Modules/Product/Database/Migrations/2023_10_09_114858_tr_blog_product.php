<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TrBlogProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tr_blog_product', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('article_id');
            // Add other columns if needed
            $table->timestamps();

            $table->unique(['product_id', 'article_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_blog_product');
    }
}
