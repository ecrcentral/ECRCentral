<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunderFundingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funder_funding', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('funder_id')->unsigned()->index();
            $table->foreign('funder_id')->references('id')->on('funders')->onDelete('cascade');
            $table->integer('funding_id')->unsigned()->index();
            $table->foreign('funding_id')->references('id')->on('fundings')->onDelete('cascade');
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
        Schema::dropIfExists('funder_funding');
    }
}
