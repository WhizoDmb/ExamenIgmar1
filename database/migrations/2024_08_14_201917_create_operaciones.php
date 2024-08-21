<?php

use App\Models\Evaluacion;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operaciones', function (Blueprint $table) {
            $table->id();
            $table->string('op1', 16);
            $table->string('op2', 16);
            $table->string('respuesta_correcta', 64);
            $table->double('respuesta_correcta_decimal')->nullable();
            $table->string('respuesta_usuario', 64)->nullable();
            $table->double('respuesta_usuario_decimal')->nullable();
            $table->enum('tipo', ['+', '-', '*', '/']);
            $table->boolean('estatus');
            $table->foreignIdFor(Evaluacion::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operaciones');
    }
};
