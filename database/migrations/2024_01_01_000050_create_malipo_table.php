<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('malipo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uuzaji_id')->constrained('mauzo')->cascadeOnDelete();
            $table->decimal('kiasi', 15, 2);
            $table->string('sarafu')->default('IQD');
            $table->date('tarehe');
            $table->text('maelezo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('malipo');
    }
};
