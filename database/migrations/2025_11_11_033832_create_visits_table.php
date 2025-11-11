<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pasien')->constrained('pasien', 'id_pasien')->onDelete('cascade');
            $table->foreignId('id_poli')->constrained('poli', 'id_poli')->onDelete('cascade');
            $table->date('visit_date');
            $table->text('keluhan')->nullable();
            $table->text('diagnosa')->nullable();
            $table->string('tindakan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
