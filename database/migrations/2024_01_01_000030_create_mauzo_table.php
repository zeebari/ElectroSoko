<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mauzo', function (Blueprint $table) {
            $table->id();
            $table->string('nambari')->unique();
            $table->foreignId('mteja_id')->nullable()->constrained('wateja')->nullOnDelete();
            $table->string('aina_malipo'); // taslimu, deni, awamu
            $table->string('sarafu')->default('IQD'); // IQD, USD
            $table->decimal('jumla', 15, 2);
            $table->decimal('ilipwa', 15, 2)->default(0);
            $table->decimal('salio', 15, 2)->default(0);
            $table->string('hali')->default('wazi'); // wazi, kumalizika
            $table->date('tarehe');
            $table->text('maelezo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mauzo');
    }
};
