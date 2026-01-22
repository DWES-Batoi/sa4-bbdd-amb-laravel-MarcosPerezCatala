<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
public function up(): void
{
    Schema::create('jugadoras', function (Blueprint $table) {
        $table->id();
        $table->string('nom');            // <--- Esta es la que falta
        $table->integer('dorsal');         // <--- Esta también
        $table->string('posicio');         // <--- Y esta
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
