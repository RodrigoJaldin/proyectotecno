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

            // Realizar la búsqueda por separado para cada tabla
            $results = [];
            $tables = ['persona', 'asistencia', 'documento', 'horario', 'licencia', 'rol', 'rotacion', 'sucursal'];

            foreach ($tables as $table) {
                if (DB::getSchemaBuilder()->hasTable($table)) {
                    $query = DB::table($table);

                    // Verificar columnas específicas por tabla
                    switch ($table) {
                        case 'persona':
                            $columns = ['id','name', 'apellido', 'ci', 'telefono', 'codigo_empleado', 'email'];
                            break;
                        case 'asistencia':
                            if (!DB::getSchemaBuilder()->hasColumn($table, 'fecha')) {
                                continue 2; // Saltar a la siguiente tabla si la columna no existe
                            }
                            $columns = ['id','fecha'];
                            break;
                        case 'documento':
                            $columns = ['id','descripcion', 'tipo_documento'];
                            break;
                        case 'horario':
                            $columns = ['id','turno'];
                            break;
                        case 'licencia':
                            if (!DB::getSchemaBuilder()->hasColumn($table, 'fecha_inicio') || !DB::getSchemaBuilder()->hasColumn($table, 'fecha_fin')) {
                                continue 2; // Saltar a la siguiente tabla si alguna columna no existe
                            }
                            $columns = ['id','fecha_inicio', 'fecha_fin', 'tipo_licencia'];
                            break;
                        case 'rol':
                            $columns = ['id','tipo_rol'];
                            break;
                        case 'rotacion':
                            $columns = ['id','fecha', 'titulo'];
                            break;
                        case 'sucursal':
                            $columns = ['id','nombre', 'direccion'];
                            break;
                        default:
                            continue 2; // Saltar a la siguiente tabla si no se encuentra en la lista de tablas
                    }

                    foreach ($columns as $column) {
                        $query->orWhere($column, 'like', '%' . $data . '%');
                    }

                    $results[$table] = $query->limit(5)->get();
                }
            }

            return response()->json([
                "estado" => 1,
                "result" => $results
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "error" => "Error en el servidor: " . $e->getMessage()
            ], 500); // Código de estado 500 para indicar error interno del servidor
        }
    }
}
