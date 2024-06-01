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
        Schema::create('blood_group_hospital', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blood_group_id');
            $table->unsignedBigInteger('hospital_id');
            $table->timestamps();

            $table->foreign('blood_group_id')->references('id')->on('blood_groups')->onDelete('cascade');
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_group_hospital');
    }
};
