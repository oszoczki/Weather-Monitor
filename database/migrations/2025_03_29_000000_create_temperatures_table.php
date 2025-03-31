<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('temperatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->decimal('temperature', 5, 2);
            $table->timestamps();

            $table->index(['location_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('temperatures');
    }
};
