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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_hora');
            $table->decimal('impuesto', 8, 2)->unsigned();
            $table->string('numero_comprobante', 255);
            $table->decimal('total', 8, 2)->unsigned();
            $table->tinyInteger('estado')->default(1);
            $table->unsignedBigInteger('forma_id')->nullable();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('comprobante_id')->nullable();
            $table->timestamps();

            
            $table->foreign('forma_id')->references('id')->on('formas')->onDelete('set null');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('comprobante_id')->references('id')->on('comprobantes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
