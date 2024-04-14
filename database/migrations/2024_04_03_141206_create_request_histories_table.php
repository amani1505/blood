<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_histories', function (Blueprint $table) {
            $table->id();
          
            $table->integer('volume');
            $table->enum('status',['pending','rejected','approved'])->default('pending');
          
            $table->unsignedBigInteger('blood_type_id'); 
            $table->unsignedBigInteger('hospital_id'); 
            $table->unsignedBigInteger('user_hospital_id');
            $table->foreign('blood_type_id')->references('id')->on('blood_groups')->onDelete('cascade'); 
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade'); 
            $table->foreign('user_hospital_id')->references('id')->on('hospitals')->onDelete('cascade'); 

        
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
        Schema::dropIfExists('request_histories');
    }
};
