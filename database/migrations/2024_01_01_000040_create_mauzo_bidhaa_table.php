<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mauzo_bidhaa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uuzaji_id')->constrained('mauzo')->cascadeOnDelete();
            $table->foreignId('bidhaa_id')->constrained('bidhaa')->cascadeOnDelete();
            $table->integer('idadi');
            $table->decimal('bei', 15, 2);
            $table->decimal('jumla', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mauzo_bidhaa');
    }
};
