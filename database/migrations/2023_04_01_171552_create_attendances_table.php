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
        Schema::create('attendances', function (Blueprint $table) {
            // 0 = hadir
            // 1 = izin
            // 4 = alpa
            // 5 = sakit
            $table->id();
            $table->string('nis', 8);
            $table->enum('status', ['0', '1', '4' ,'5']);
            $table->date('date');
            $table->string('note')->nullable();
            $table->string('teacher_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
