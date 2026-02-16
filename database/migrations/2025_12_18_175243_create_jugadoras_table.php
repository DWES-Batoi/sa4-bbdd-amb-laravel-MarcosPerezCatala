<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('jugadoras', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->integer('dorsal');
            $table->string('posicio');
            $table->integer('edat')->nullable();
            $table->foreignId('equip_id')->constrained('equips')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadoras');
    }
};
