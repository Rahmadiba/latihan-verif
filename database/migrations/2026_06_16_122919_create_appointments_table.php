<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
          
            $table->foreignId('konsuli_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('konselor_id')->constrained('users')->onDelete('cascade');

            $table->date('tanggal_temu');
            $table->text('keluhan');
            $table->string('status')->default('pending'); 
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('appointments');
    }
};