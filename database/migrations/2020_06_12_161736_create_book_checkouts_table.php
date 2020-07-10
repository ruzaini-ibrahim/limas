<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_checkouts', function (Blueprint $table) {
            $table->id();
            $table->string('book_item_id');
            $table->enum('status', ['borrowed','returned','delayed'])->default('borrowed');
            $table->string('borrowed_by')->nullable();
            $table->timestamp('due_date', 0)->nullable();
            $table->timestamp('return_date', 0)->nullable();
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
        Schema::dropIfExists('book_checkouts');
    }
}
