@extends('layouts.app')

@section('content')
    <h2>Lista de Servicios Realizados</h2>

    <form method="GET" action="{{ route('servicios.index') }}" class="mb-3">
        <label for="estado_servicio" class="form-label">Filtrar por estado:</label>
        <select name="estado_servicio" id="estado_servicio" class="form-select" onchange="this.form.submit()">
            <option value="">-- Todos --</option>
            @foreach(['Pendiente', 'Realizado', 'Facturado', 'Cancelado'] as $estado)
                <option value="{{ $estado }}" {{ request('estado_servicio') == $estado ? 'selected' : '' }}>{{ $estado }}</option>
            @endforeach
        </select>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('servicios.create') }}" class="btn btn-primary mb-3">Registrar nuevo servicio</a>
    <form method="GET" action="{{ route('servicios.export-json') }}" class="mb-3">
    <input type="hidden" name="estado_servicio" value="{{ request('estado_servicio') }}">
    <button type="submit" class="btn btn-success">Exportar JSON</button>
</form>


    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Trabajo</th>
                <th>Monto (S/)</th>
                <th>Estado</th>
                <th>Electricista</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicios as $servicio)
                <tr>
                    <td>{{ $servicio->id_servicio }}</td>
                    <td>{{ $servicio->fecha_servicio }}</td>
                    <td>{{ $servicio->nombre_cliente }}</td>
                    <td>{{ $servicio->direccion_cliente }}</td>
                    <td>{{ $servicio->telefono_cliente ?? '-' }}</td>
                    <td>{{ $servicio->descripcion_trabajo }}</td>
                    <td>{{ number_format($servicio->monto_total, 2) }}</td>
                    <td>{{ $servicio->estado_servicio }}</td>
                    <td>{{ $servicio->electricista_asignado ?? '-' }}</td>
                    <td>
                        <a href="{{ route('servicios.edit', $servicio->id_servicio) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('servicios.destroy', $servicio->id_servicio) }}" method="POST" style="display:inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este servicio?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
