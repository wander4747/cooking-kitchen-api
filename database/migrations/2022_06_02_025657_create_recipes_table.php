<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('title', 150)->unique();
            $table->string('slug', 170)->unique();
            $table->string('category_uuid');
            $table->string('gallery_directory', 170)->nullable();
            $table->string('preparation_time', 150);
            $table->integer('difficulty');
            $table->integer('number_of_people_served');
            $table->longText('ingredients');
            $table->longText('preparation_mode');
            $table->boolean('is_active');
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
};
