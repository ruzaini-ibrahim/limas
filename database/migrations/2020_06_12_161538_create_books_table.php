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
        //primary table
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn',100)->comment('usually 13/15 length');
            $table->string('title')->nullable();
            $table->string('publisher')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->enum('type', ['0','1'])->default('1')->comment('1 => fiction, 0 => non-fiction');
            $table->enum('status', ['available','not available','reserved','missing'])->default('available');
            $table->timestamps();
        });

        //run migrate for foreign table
        Artisan::call('migrate --path=database/migrations/2020_06_12_161552_create_book_items_table.php');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */



    // Note* 
    // Need drop foreign table 1st before can drop primary table(books)
    // foreign table: book_items
    public function down()
    {
        //foreign table
        Artisan::call('migrate:reset --path=database/migrations/2020_06_12_161552_create_book_items_table.php');
        // Schema::dropIfExists('book_items');
        Schema::dropIfExists('books');
    }
}
