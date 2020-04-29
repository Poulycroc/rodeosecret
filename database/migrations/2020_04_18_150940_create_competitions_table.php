<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('type')->default('Concours');
            $table->boolean('in_landing')->default(1); // true
            $table->boolean('on_top')->default(1); // true
            $table->date('publication')->default(Carbon::now());
            $table->date('start_event');
            $table->longText('description')->nullable();

            $table->integer('category_id')
                  ->unsigned();

            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories');

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
        Schema::dropIfExists('competitions');
    }
}
