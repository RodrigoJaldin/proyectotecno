<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentos = Documento::all();
        return view('documento.index', compact('documentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('documento.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|min:1',
            'tipo_documento' => 'required|min:1',
            'archivo' => 'required|file',
            'id_user' => 'required|exists:users,id',
        ]);

        $documento = new Documento();

        $documento->descripcion = $request->descripcion;
        $documento->tipo_documento = $request->tipo_documento;
        $documento->id_user = $request->id_user;

        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo')->store('public/documentos_archivos');
            $url = Storage::url($archivo);
            $documento->archivo = $url;
        }

        $documento->save();

        // Redireccionar a la vista index con un mensaje de éxito
        return redirect()->route('documento.index')->with('success', 'El documento ha sido creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Documento $documento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documento $documento)
    {
        return view('documento.edit', compact('documento'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Documento $documento)
    {
        $request->validate([
            'descripcion' => 'required|min:1',
            'tipo_documento' => 'required|min:1',
            'id_user' => 'required|exists:user,id',

        ]);


        $documento = new Documento();

        $documento->descripcion = $request->descripcion;
        $documento->tipo_documento = $request->tipo_documento;

        if ($request->hasFile('archivo')) {
            // Eliminar la foto anterior si existe
            if ($documento->archivo) {
                Storage::delete($documento->archivo);
            }

            $archivos = $request->file('archivo')->store('public/documentos_archivos');
            $url = Storage::url($archivos);
            $documento->archivo = $url;
        }

        $documento->save();

        // Redireccionar a la vista index con un mensaje de éxito
        return redirect()->route('documento.index')->with('edit-success', 'El documento ha sido editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documento $documento)
    {
        $documento->delete();
        return redirect()->route('documento.index')->with('success', 'El documento se ha eliminado correctamente.');
    }
}
