<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('movimientos')) {
            Schema::create('movimientos', function (Blueprint $table) {
                $table->id();
                $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
                $table->string('tipo', 255);
                $table->integer('cantidad');
                $table->date('fecha');
                $table->decimal('costo', 8, 2);
                $table->decimal('precio', 8, 2);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
}
