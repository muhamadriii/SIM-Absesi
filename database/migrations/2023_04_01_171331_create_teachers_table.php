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
        // Schema::create('teachers', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('role');
        //     $table->string('name');
        //     $table->string('nip', 18);
        //     $table->enum('jk', ['laki-laki', 'perempuan']);
        //     $table->date('dob');
        //     $table->string('telp', 15);
        //     $table->text('address');
        //     $table->timestamps();
        //     $table->softDeletes();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
