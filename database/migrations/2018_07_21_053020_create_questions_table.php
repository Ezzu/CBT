<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('statement');
            $table->integer('subsection_id');
            $table->string('user_id');
            $table->string('supervisor_id')->default(0);
            $table->timestamp('user_time')->default(\Carbon\Carbon::now()->toDateTimeString());
            $table->timestamp('supervisor_time')->default(\Carbon\Carbon::now()->toDateTimeString());
            $table->string('difficulty_level');
            $table->integer('maximum_age');
            $table->integer('current_age')->default(0);
            $table->integer('priority');
            $table->integer('success_ratio')->default(100);
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('questions');
    }
}
