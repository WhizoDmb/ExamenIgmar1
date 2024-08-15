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
            $table->double('op1', 8, 2);
            $table->double('op2', 8, 2);
            $table->double('respuesta_correcta', 8, 2);
            $table->double('respuesta_usuario', 8, 2)->nullable();
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
