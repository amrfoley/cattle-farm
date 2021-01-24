<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use Carbon\Carbon;

class CreateCattlePastureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cattle_pasture', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasture_id');
            $table->unsignedBigInteger('cattle_id');
            // $table->date('day')->default(Carbon::now());
            $table->foreign('pasture_id')->references('id')->on('pastures');
            $table->foreign('cattle_id')->references('id')->on('cattles');
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
        Schema::dropIfExists('cattle_pasture');
    }
}
