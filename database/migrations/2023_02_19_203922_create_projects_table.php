<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//anonymous class with out name
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); //biginteger unsigned Auto_Increment Primary
            // id == id2
            // $table->bigInteger('id2')->unsigned()->autoIncrement()->primary();
            // ==
            // $table->unsignedBigInteger('id');
            $table->string('name');
            $table->text('description');
            $table->dateTime('time_first');
            $table->text('notes');
            $table->dateTime('time_function');
            $table->string('additional_file', 90);
            $table->integer('value');
            $table->string('funds', 45);
            $table->integer('city_id');
            $table->boolean('accept')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
