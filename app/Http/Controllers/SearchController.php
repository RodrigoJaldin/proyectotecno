<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class SearchController extends Controller
{
    public function show(Request $request)
    {
        try {
            $data = trim($request->valor);
            $result = DB::table('user')
                ->where('name', 'like', '%' . $data . '%')
                ->orWhere('apellido', 'like', '%' . $data . '%')
                ->limit(5)
                ->get();

            return response()->json([
                "estado" =>1,
                "result" => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "error" => "Error en el servidor: " . $e->getMessage()
            ], 500); // Código de estado 500 para indicar error interno del servidor
        }
    }
}
