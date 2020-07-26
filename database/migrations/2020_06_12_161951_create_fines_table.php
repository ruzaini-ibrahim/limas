<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fines', function (Blueprint $table) {
            $table->id();
            $table->string('book_item_id');
            $table->enum('status', ['not paid','paid'])->default('not paid');
            $table->string('borrowed_by')->nullable();
            $table->timestamp('due_date', 0)->nullable();
            $table->timestamp('return_date', 0)->nullable();
            $table->timestamp('paid_date', 0)->nullable();
            $table->double('paid_value',8,2)->default(0);
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
        Schema::dropIfExists('fines');
    }
}
