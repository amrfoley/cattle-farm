<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pastures', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->enum('grass', ['short', 'medium', 'long']);
            $table->enum('weather', ['dry', 'windy', 'rainy', 'cool', 'hot', 'normal']);
            $table->integer('temperature');
            $table->integer('bulls')->default(10);
            $table->integer('cows')->default(10);
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
        Schema::dropIfExists('pastures');
    }
}
