<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoicedbs', function (Blueprint $table) {
            $table->id();
            $table->string('invoicenumber' , 255);
            $table->integer('contractperiod');
            $table->date('doi');
            $table->string('customername' , 255);
            $table->string('address' , 255);
            $table->string('typeps' , 255);
            $table->json('data');
            $table->decimal('totalamount',8,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoicedbs');
    }
};
