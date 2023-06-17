<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('edition');
            $table->string('type');
            $table->string('price');
            $table->boolean('on_sale')->default(false);
            $table->string('sale_price')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('author_id')->constrained();
            $table->foreignId('publisher_id')->constrained();
            $table->foreignId('media_id')->nullable();
            $table->foreignId('sample_pdf_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
