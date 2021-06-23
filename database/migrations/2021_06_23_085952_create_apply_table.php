<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply', function (Blueprint $table) {
            $table->bigIncrements('apply_id');
            $table->text('note')->nullable();
            $table->string('document');
            $table->foreignId('job_id')->references('job_id')->on('job_vacancies');
            $table->foreignId('company_id')->references('company_id')->on('companies');
            $table->foreignId('freelance_id')->references('freelance_id')->on('freelances');
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
        Schema::dropIfExists('apply');
    }
}
