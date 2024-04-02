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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('quantity');
            $table->string('status');
            $table->id('blood_type_id'); 
            $table->id('hospital_id'); 
            $table->foreign('blood_type_id')->references('id')->on('blood_groups')->onDelete('cascade'); 
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
