<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('weather', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('city_id')->nullable()->index();
            $table->date('date')->nullable()->index();
            $table->string('time')->nullable();
            $table->string('sunrise')->nullable();
            $table->string('sunset')->nullable();
            $table->float('temp', 11, 2)->nullable()->index();
            $table->float('pressure', 11, 2)->nullable()->index();
            $table->integer('humidity')->nullable();
            $table->integer('visibility')->nullable();
            $table->string('wind_speed')->nullable();
            $table->string('weather')->nullable();
            $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('weather');
    }
}
