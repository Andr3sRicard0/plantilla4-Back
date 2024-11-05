<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class studentController extends Controller
{
    public function index()
    {
        $datos = Student::all();

        if ($datos->isEmpty()) {
            $data = [
                'message' => 'No hay estudiantes registrados.',
                'status' => 200

            ];
            return response()->json($data, 200);
        }
        return response()->json($datos, 200);
    }

    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'student' => $student,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'primerPago' => 'required|numeric',
            'segundoPago' => 'required|numeric',
            'totalPago' => 'required|numeric'
        ]);

        // Condicional para verificar que se enviaron todos los datos de manera correcta
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Crear un nuevo estudiante
        $student = Student::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'primerPago' => $request->primerPago,
            'segundoPago' => $request->segundoPago,
            'totalPago' => $request->totalPago
        ]);

        // Verificar si se creó correctamente
        if (!$student) {
            $data = [
                'message' => 'Error al crear estudiante',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        // Respuesta exitosa
        $data = [
            'message' => 'Estudiante creado exitosamente',
            'student' => $student,
            'status' => 201
        ];
        return response()->json($data, 201);
    }
    //Funcion para editar estudiante
    public function update(Request $request, $id){
        $student = Student::find($id);
        if (!$student) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'primerPago' => 'required|numeric',
            'segundoPago' => 'required|numeric',
            'totalPago' => 'required|numeric'
        ]);

         // Condicional para verificar que se enviaron todos los datos de manera correcta
         if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        
        $student->nombres = $request->nombres;
        $student->apellidos = $request->apellidos;
        $student->primerPago = $request->primerPago;
        $student->segundoPago = $request->segundoPago;
        $student->totalPago = $request->totalPago;

        $student->save();
        
        $data = [
            'message' => 'Estudiante actualizado',
            'student' => $student,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    //Funcion para eliminar estudiantes
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $student->delete();

        $data = [
            'message' => 'Estudiante Eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
