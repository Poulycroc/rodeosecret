<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionParticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_participant', function (Blueprint $table) {
            $table->integer('participant_id')
                  ->unsigned();

            $table->foreign('participant_id')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

                  
            $table->integer('competition_id')
                  ->unsigned();

            $table->foreign('competition_id')
                  ->references('id')
                  ->on('competitions')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->primary(['participant_id', 'competition_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competition_participant');
    }
}
