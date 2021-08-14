<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractKlienPivotTable extends Migration
{
    public function up()
    {
        Schema::create('contract_klien', function (Blueprint $table) {
            $table->unsignedBigInteger('contract_id');
            $table->foreign('contract_id', 'contract_id_fk_4610815')->references('id')->on('contracts')->onDelete('cascade');
            $table->unsignedBigInteger('klien_id');
            $table->foreign('klien_id', 'klien_id_fk_4610815')->references('id')->on('kliens')->onDelete('cascade');
        });
    }
}
