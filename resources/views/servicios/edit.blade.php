@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Editar Servicio</h2>

    <form method="POST" action="{{ route('servicios.update', $servicio->id_servicio) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Fecha del servicio:</label>
            <input type="date" name="fecha_servicio" value="{{ $servicio->fecha_servicio }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre del cliente:</label>
            <input type="text" name="nombre_cliente" value="{{ old('nombre_cliente', $servicio->nombre_cliente) }}" class="form-control" required>
            @error('nombre_cliente')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Dirección del cliente:</label>
            <input type="text" name="direccion_cliente" value="{{ old('direccion_cliente', $servicio->direccion_cliente) }}" class="form-control" required>
            @error('direccion_cliente')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Teléfono del cliente:</label>
            <input type="text" name="telefono_cliente" value="{{ old('telefono_cliente', $servicio->telefono_cliente) }}" class="form-control">
            @error('telefono_cliente')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción del trabajo:</label>
            <textarea name="descripcion_trabajo" class="form-control" rows="3" required>{{ old('descripcion_trabajo', $servicio->descripcion_trabajo) }}</textarea>
            @error('descripcion_trabajo')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Monto total:</label>
            <input type="number" step="0.01" name="monto_total" value="{{ old('monto_total', $servicio->monto_total) }}" class="form-control" required>
            @error('monto_total')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Estado del servicio:</label>
            <select name="estado_servicio" class="form-select" required>
                @foreach(['Pendiente', 'Realizado', 'Facturado', 'Cancelado'] as $estado)
                    <option value="{{ $estado }}" {{ old('estado_servicio', $servicio->estado_servicio) == $estado ? 'selected' : '' }}>{{ $estado }}</option>
                @endforeach
            </select>
            @error('estado_servicio')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Electricista asignado:</label>
            <input type="text" name="electricista_asignado" value="{{ old('electricista_asignado', $servicio->electricista_asignado) }}" class="form-control">
            @error('electricista_asignado')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Servicio</button>
        <a href="{{ route('servicios.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
@endsection
