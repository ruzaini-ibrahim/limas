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
            $table->string('isbn',100)->comment('usually 13/15 length');
            $table->string('title')->nullable();
            $table->string('publisher')->nullable();
            $table->string('image_path')->nullable();
            $table->string('image_url')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->enum('type', ['0','1'])->default('1')->comment('1 => fiction, 0 => non-fiction');
            $table->enum('status', ['available','not available','reserved','missing'])->default('available');
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
        //foreign table
        // Schema::dropIfExists('book_items');
        Schema::dropIfExists('books');
    }
}
