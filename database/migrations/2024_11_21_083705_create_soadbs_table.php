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
        Schema::create('soadbs', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name' , 255);
            $table->date('date');
            $table->string('typeps' , 255);
            $table->decimal('totalamount' , 8 , 2);
            $table->json('data');
            $table->string('invoicenumber' , 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soadbs');
    }
};
