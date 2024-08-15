<?php

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
    // php artisan make:migration add_rol_to_users_table --table=users
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('rol')->default('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rol');
        });
    }

    /* // Encuentra el usuario por su ID, o por otro campo único como email
    $user = User::find($id);  // $id es el ID del usuario

    // Actualiza el campo 'rol'
    $user->rol = 'admin';  // Cambia 'admin' por el rol que quieras asignar

    // Guarda los cambios en la base de datos
    $user->save(); */
};
