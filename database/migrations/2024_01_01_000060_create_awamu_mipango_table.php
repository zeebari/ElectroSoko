<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('awamu_mipango', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uuzaji_id')->constrained('mauzo')->cascadeOnDelete();
            $table->integer('idadi_awamu');
            $table->decimal('kiasi_kila_awamu', 15, 2);
            $table->date('tarehe_mwanzo');
            $table->integer('siku_baina')->default(30);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('awamu_mipango');
    }
};
