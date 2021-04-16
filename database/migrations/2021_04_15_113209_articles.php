<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Articles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->string('image');
            $table->longText('content');
            $table->bigInteger('hit')->default(0);
            $table->bigInteger('status')->default(0)->comment('0: Pasit 1:Aktif. Aktif olduktan sonra anasyafaya duser');
            $table->string('slug');
            $table->softDeletes();
            $table->timestamps();

            // categories tablosu ile article tablosunu birbirine bagladık
            // onDelete kısmı ilgili kategoriye ait ilgili yazıları da siler onDelete('cascade')
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
