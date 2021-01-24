<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCattleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cattles', function (Blueprint $table) {
            $table->id();
            $table->string('serial')->unique();
            $table->enum('gender', ['bull', 'cow']);
            $table->integer('age')->default(0);
            $table->double('weight', 8, 2);
            $table->string('color');
            $table->double('price', 8, 2);
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
        Schema::dropIfExists('cattles');
    }
}
