<?php

namespace App\Http\Controllers;

use App\Models\Gastos;
use Illuminate\Http\Request;

class gastosController extends Controller
{
    public function index(){
        $gastos = Gastos::all();
        if($gastos->isEmpty()){
            $data = [
                'message' => 'No hay gastos en la bd',
                'status' => 200
            ];
            return response()->json($data, 200);
        }
        return response()->json($gastos, 200);
    }
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
}
