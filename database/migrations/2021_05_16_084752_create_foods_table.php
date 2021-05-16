<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('categories')->nullable();
            $table->json('meals')->nullable();
            $table->json('requirements')->nullable();
            $table->text('items_needed')->nullable();
            $table->text('recipe')->nullable();
            $table->text('details')->nullable();
            $table->json('tags')->nullable();
            $table->json('images')->nullable();
            $table->string('link')->nullable();
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
        Schema::dropIfExists('foods');
    }
}
