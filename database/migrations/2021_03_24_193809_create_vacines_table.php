<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacines', function (Blueprint $table) {
            $table->id();
            $table->string('manufacturer');
            $table->string('expirationDate');
            $table->string('lote');
            $table->integer('dosesNumber');
            $table->integer('daysInterval');
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
        Schema::dropIfExists('vacines');
    }
}
