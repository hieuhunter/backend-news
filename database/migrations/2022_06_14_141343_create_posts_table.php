<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
			$table->foreignId('category_id')->constrained('categories');
			$table->string('title');
			$table->string('slug')->unique();
			$table->string('excerpt', 666)->nullable();
			$table->text('content');
			$table->string('image')->nullable();
			$table->enum('status', ['publish', 'pending', 'draft', 'trash'])->default('draft');
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
        Schema::dropIfExists('posts');
    }
}
