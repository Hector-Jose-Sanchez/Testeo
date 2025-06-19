<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
   public function index(Request $request)
{
    $query = Servicio::query();

    if ($request->filled('estado_servicio')) {
        $query->where('estado_servicio', $request->estado_servicio);
    }

    $servicios = $query->orderBy('fecha_servicio', 'desc')->get();

    $estados = ['Pendiente', 'Realizado', 'Facturado', 'Cancelado'];

    return view('servicios.index', compact('servicios', 'estados'));
}



    public function create()
    {
        return view('servicios.create');
    }

    public function store(Request $request)
    {
    $request->validate([
    'nombre_cliente' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'],
    'fecha_servicio' => 'required|date',
    'direccion_cliente' => 'required|string|max:255',
    'telefono_cliente' => ['nullable', 'regex:/^[0-9\s\-\(\)]+$/', 'max:20'],
    'descripcion_trabajo' => 'required|string',
    'monto_total' => 'required|numeric|min:0',
    'estado_servicio' => 'required|in:Pendiente,Realizado,Facturado,Cancelado',
    'electricista_asignado' => ['nullable', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/', 'max:100'],
], [
    'nombre_cliente.regex' => 'El nombre solo debe contener letras y espacios.',
    'telefono_cliente.regex' => 'El teléfono solo debe contener números, espacios, guiones o paréntesis.',
    'electricista_asignado.regex' => 'El nombre del electricista solo debe contener letras y espacios.',
]);


        Servicio::create($request->all());

        return redirect()->route('servicios.index')->with('success', 'Servicio registrado correctamente.');
    }

    public function edit($id)
    {
        $servicio = Servicio::findOrFail($id);
        return view('servicios.edit', compact('servicio'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
    'nombre_cliente' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'],
    'fecha_servicio' => 'required|date',
    'direccion_cliente' => 'required|string|max:255',
    'telefono_cliente' => ['nullable', 'regex:/^[0-9\s\-\(\)]+$/', 'max:20'],
    'descripcion_trabajo' => 'required|string',
    'monto_total' => 'required|numeric|min:0',
    'estado_servicio' => 'required|in:Pendiente,Realizado,Facturado,Cancelado',
    'electricista_asignado' => ['nullable', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/', 'max:100'],
], [
    'nombre_cliente.regex' => 'El nombre solo debe contener letras y espacios.',
    'telefono_cliente.regex' => 'El teléfono solo debe contener números, espacios, guiones o paréntesis.',
    'electricista_asignado.regex' => 'El nombre del electricista solo debe contener letras y espacios.',
]);

        $servicio = Servicio::findOrFail($id);
        $servicio->update($request->all());

        return redirect()->route('servicios.index')->with('success', 'Servicio actualizado correctamente.');
    }
    public function destroy($id)
{
    $servicio = Servicio::findOrFail($id);
    $servicio->delete();

    return redirect()->route('servicios.index')->with('success', 'Servicio eliminado correctamente.');
}
public function exportJson(Request $request)
{
    $query = Servicio::query();

    if ($request->filled('estado_servicio')) {
        $query->where('estado_servicio', $request->estado_servicio);
    }

    $servicios = $query->orderBy('fecha_servicio', 'desc')->get();

    $filename = 'servicios_export_' . date('Ymd_His') . '.json';
    $jsonContent = $servicios->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    return response($jsonContent, 200, [
        'Content-Type' => 'application/json',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
    ]);
}

}

