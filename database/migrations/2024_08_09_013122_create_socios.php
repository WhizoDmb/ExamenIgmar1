<?php

use App\Models\Membresia;
use App\Models\Modalidad;
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
        Schema::create('socios', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("apaterno");
            $table->string("amaterno");
            $table->string("telefono")->unique();
            $table->string('email')->unique();
            $table->foreignIdFor(Modalidad::class);
            $table->foreignIdFor(Membresia::class);
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
        Schema::dropIfExists('socios');
    }
};
