<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * Método obtener detalles de la tarea.
     * Recibe como parámetro el siguientes: id: int
     * @author Gian Vespa
     */
    public function index($id = false): JsonResponse
    {
        // buscar por id
        if ($id){
            $task = Task::whereId($id)->first();
            if($task){
                return response()->json($task, 200);
            }
            return response()->json('Registro no encontrado', 200);
            
        }else{
        // buscar todos
            $task = Task::all();
            return response()->json($task, 200);
        }
        
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * Método para crear registro.
     * Recibe como parámetro los siguientes: ('name' :string), ('activated' :boolean (true || 1)).
     * @author Gian Vespa
     */
    public function create(Request $request): JsonResponse
    {
       //create register
        $task = Task::create([
            'name' => $request->name,
            'activated' => $this->activation($request->activated)
        ]);

        return response()->json($task, 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * Método para actualizar un registro.
     * Pasar como parametro: id
     * para actualizar cualquiera de estos datos: ('name' :string), ('activated' :boolean (true || 1)).
     * @author Gian Vespa
     */
    public function update(Request $request, $id): JsonResponse
    {
        $task = Task::whereId($id)->first();

        if($task){

            //update the state register 
            if($request->activated){
                $task->update(['activated' => $this->activation($request->activated)]);
            }

            //update name register
            if($request->name){
                $task->update(['name' => $request->name]);
            }

            //scarh register and return
            $task = Task::whereId($id)->first();
            return response()->json($task, 200);
        }
        return response()->json('Registro no encontrado', 200);
    }

    /**
     * @return JsonResponse
     * Método para eliminar un registro.
     * Recibe como parámetros el siguientes: id
     * @author Gian Vespa
     */
    public function destroy($id): JsonResponse
    {
        try {
            $task = Task::whereId($id)->first();
            if ($task){
                $task->delete();
                return response()->json('Eliminado con éxito', 200);
            }
            return response()->json('Registro no encontrado', 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 401);
        }
    }

    /**
     * @return bool
     * Método de verificación de activación 
     * Recibe como parámetros el siguientes: (activated = true or 1: boolean). 
     * @author Gian Vespa
     */
    private function activation($activated): bool {
       if($activated === 'true' || $activated === '1'){
        return true;
       }
       return false;
    }
}
