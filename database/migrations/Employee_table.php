<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('data_nasc');
            $table->string('cpf', 14)->unique();
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};