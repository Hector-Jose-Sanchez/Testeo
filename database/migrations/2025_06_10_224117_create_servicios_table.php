<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id('id_servicio');
            $table->date('fecha_servicio');
            $table->string('nombre_cliente', 100);
            $table->string('direccion_cliente', 255);
            $table->string('telefono_cliente', 20)->nullable();
            $table->text('descripcion_trabajo');
            $table->decimal('monto_total', 10, 2);
            $table->string('estado_servicio', 50);
            $table->string('electricista_asignado', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
