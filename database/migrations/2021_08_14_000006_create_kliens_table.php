<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKliensTable extends Migration
{
    public function up()
    {
        Schema::create('kliens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('province');
            $table->string('city');
            $table->string('sub_district');
            $table->string('ward');
            $table->string('number')->nullable();
            $table->string('address');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
