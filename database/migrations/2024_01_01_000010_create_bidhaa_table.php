<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bidhaa', function (Blueprint $table) {
            $table->id();
            $table->string('jina');
            $table->string('aina')->nullable();
            $table->decimal('bei_ununuzi', 15, 2)->default(0);
            $table->decimal('bei_uuzaji', 15, 2);
            $table->integer('hisa')->default(0);
            $table->text('maelezo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bidhaa');
    }
};
