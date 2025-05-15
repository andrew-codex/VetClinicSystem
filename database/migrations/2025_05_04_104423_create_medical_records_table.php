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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->string('pet_name');
            $table->string('Owner_name');
            $table->date('visit_date'); 
            $table->string('diagnosis', 255); 
            $table->text('treatment')->nullable(); 
            $table->text('prescription')->nullable(); 
            $table->text('notes')->nullable(); 
            $table->date('next_visit_date')->nullable();
            $table->timestamps(); 
            
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
