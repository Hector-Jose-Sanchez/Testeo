@extends('layouts.app')

@section('content')
<h2 class="mb-4">Nuevo Servicio</h2>

<form method="POST" action="{{ route('servicios.store') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Fecha:</label>
        <input type="date" name="fecha_servicio" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Cliente:</label>
        <input type="text" name="nombre_cliente" class="form-control" value="{{ old('nombre_cliente') }}" required>
        @error('nombre_cliente')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Dirección:</label>
        <input type="text" name="direccion_cliente" class="form-control" value="{{ old('direccion_cliente') }}" required>
        @error('direccion_cliente')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Teléfono:</label>
        <input type="text" name="telefono_cliente" class="form-control" value="{{ old('telefono_cliente') }}">
        @error('telefono_cliente')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción del trabajo:</label>
        <textarea name="descripcion_trabajo" class="form-control" rows="3" required>{{ old('descripcion_trabajo') }}</textarea>
        @error('descripcion_trabajo')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Monto:</label>
        <input type="number" step="0.01" name="monto_total" class="form-control" value="{{ old('monto_total') }}" required>
        @error('monto_total')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Estado:</label>
        <select name="estado_servicio" class="form-select" required>
            @foreach(['Pendiente', 'Realizado', 'Facturado', 'Cancelado'] as $estado)
                <option value="{{ $estado }}" {{ old('estado_servicio') == $estado ? 'selected' : '' }}>{{ $estado }}</option>
            @endforeach
        </select>
        @error('estado_servicio')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Electricista:</label>
        <input type="text" name="electricista_asignado" class="form-control" value="{{ old('electricista_asignado') }}">
        @error('electricista_asignado')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('servicios.index') }}" class="btn btn-secondary ms-2">Volver</a>
</form>
@endsection
