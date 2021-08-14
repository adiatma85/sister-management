<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSistersTable extends Migration
{
    public function up()
    {
        Schema::create('sisters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('province');
            $table->string('city');
            $table->string('sub_district');
            $table->string('ward');
            $table->string('address');
            $table->string('number')->nullable();
            $table->integer('age');
            $table->string('status');
            $table->decimal('prefered_salary', 15, 2);
            $table->string('type');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
