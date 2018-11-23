<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fundings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('url');
            $table->string('funder_id')->nullable();
            $table->string('funder_name');
            $table->string('host_country');
            $table->string('applicant_country');
            $table->string('academic_level')->nullable();
            $table->string('years_since_phd')->nullable();
            $table->string('duration')->nullable();
            $table->string('award')->nullable();
            $table->string('award_type')->nullable();
            $table->string('research_costs')->nullable();
            $table->string('deadline')->nullable();
            #$table->text('subjects')->nullable();
            $table->string('diversity')->nullable();
            $table->text('comments')->nullable();
            $table->integer('user_id')->unsigned()->default(1);
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('fundings');
    }
}
