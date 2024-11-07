<?php

namespace App\Http\Controllers;

use App\Models\Gastos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\error;

class gastosController extends Controller
{
    //llamar a todos los datos
    public function index(){
        $gastos = Gastos::all();
        if($gastos->isEmpty()){
            $data = [
                'message' => 'No hay datos en la bd',
                'status' => 200
            ];
            return response()->json($data, 200);
        }
        return response()->json($gastos, 200);
    }
    //llamar a los datos por id
    public function show($id){
        $gastos = Gastos::find($id);
        if(!$gastos){
            $data = [
                'message' => 'Referencia de gasto no encontrada',
                'status'=> 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'gasto' => $gastos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    //crear datos
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'descripcion' => 'required|string|max:255',
            'costo' => 'required|numeric'
        ]);
        //verificar que la data que se envia no tiene algun tipo de error
        if($validator->fails()){
            $data = [
                'message' => 'Error en envío de la data gastos',
                'errors ' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        
        $gastos = Gastos::create([
            'descripcion' => $request->descripcion,
            'costo' => $request->costo
        ]);
        //verificar si la creacion se hizo de manera satisfactoria
        if(!$gastos){
            $data = [
                'message' => 'Error al crear la data gastos',
                'status' => 500
            ];
            return response()->json($data, 500);
        }
        //repuesta de creacion exitosa
        $data = [
            'message' => 'Creación exitosa de la data gastos',
            'gasto' => $gastos,
            'status' => 201
        ];
        return response()->json($data, 201);
    }
    //actualizar un dato
    public function update(Request $request, $id){
        $gastos = Gastos::find($id);
        if(!$gastos){
            $data = [
                'message' => 'Gasto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required|string|max:255',
            'costo' => 'required|numeric'
        ]);
        //condicional si falla el validator de la data
        if($validator->fails()){
            $data = [
                'message' => 'Error al ingreso de la data de gastos',
                'status' => 500
            ];
            return response()->json($data, 500);
        }
        $gastos->descripcion = $request->descripcion;
        $gastos->costo = $request->costo;
        
        $gastos->save();

        $data = [
            'message' => 'Data de gasto creada de manera exitosa',
            'gasto' => $gastos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    //funcion para eliminar data
    public function destroy($id){
        $gastos = Gastos::find($id);
        //Error al no encontrar la data
        if(!$gastos){
            $data = [
                'message' => 'Error al encontrar la data gasto',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $gastos->delete();
        $data = [
            'message' => 'Dato de gasto eliminado de manera correcta',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
