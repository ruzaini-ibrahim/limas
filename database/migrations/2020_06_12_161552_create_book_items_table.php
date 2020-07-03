<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_items', function (Blueprint $table) {
            $table->id();
            $table->string('refNo');
            $table->unsignedBigInteger('book_id'); //foreign key must be the same type as the reference's (books) primary key. 
            $table->enum('status', ['available','not available','reserved','missing'])->default('available');
            $table->timestamp('borrowed_on', 0)->nullable();
            $table->string('borrowed_by')->nullable();
            $table->timestamp('due_date', 0)->nullable();
            $table->string('reserved_by')->nullable();
            $table->timestamps();

        $table->foreign('book_id')
          ->references('id')
          ->on('books')
          ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_items');
    }
}
