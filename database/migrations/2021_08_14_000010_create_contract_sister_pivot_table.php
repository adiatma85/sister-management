<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractSisterPivotTable extends Migration
{
    public function up()
    {
        Schema::create('contract_sister', function (Blueprint $table) {
            $table->unsignedBigInteger('contract_id');
            $table->foreign('contract_id', 'contract_id_fk_4610814')->references('id')->on('contracts')->onDelete('cascade');
            $table->unsignedBigInteger('sister_id');
            $table->foreign('sister_id', 'sister_id_fk_4610814')->references('id')->on('sisters')->onDelete('cascade');
        });
    }
}
