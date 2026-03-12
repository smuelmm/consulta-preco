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
        Schema::create('autorizadas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('pessoa');
            $table->string('nome');
            $table->decimal('valor', total: 10, places: 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autorizadas');
    }
};
