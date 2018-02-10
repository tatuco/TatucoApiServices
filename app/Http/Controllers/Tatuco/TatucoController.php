<?php

namespace App\Http\Controllers\Tatuco;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Optimus\Bruno\EloquentBuilderTrait;
use Optimus\Bruno\LaravelController;
use Tymon\JWTAuth\JWTAuth;


class TatucoController
{
    //use EloquentBuilderTrait;

    public $service;
    /**
     * listar registros del objeto
     */
    public function index(Request $request)
    {
        return $this->service->index();
    }
    /**
     * consultar un registro por id, el objeto sera el que se traiga el metodo find() que busca una registro
     * por id, si no existe enviamos la respuesta json con un mensaje y codigo
     * si existe retornamos el json con el objeto
     */
    public function show($id)
    {
        return $this->service->show($id);
    }
    /**
     * guardar todo el request, pasamos la data al metodo create() del modelo
     * retornamos el objeto en formato json
     */
    public function _store()
    {
        return $this->service->store();
    }
    /**
     * actualizar un registro recibiendo el id buscandolo con el metodo findOrFail()
     *
     */
    public function _update($id)
    {
       return $this->service->update($id);
    }

    /**
     * metodo para eliminar un registro
     */
    public function destroy($id)
    {
        try{
            $this->object = $this->model->findOrFail($id);

            if(!$this->object)
            {
                return response()->json([
                   'msj'=>$this->name.' no existe'
                ],404);
            }
            $this->object->delete();

            return response()->json([
                $this->name.' Eliminado'
            ],200);

        }catch (\Exception $e){
            Log::critical("Error, archivo del peo: {$e->getFile()}, linea del peo: {$e->getLine()}, el peo: {$e->getMessage()}");
            return response()->json(["msj"=>"Error de servidor"], 500);
        }
    }

    public function create(){
        return $this->service->create(); 
    }

    public function prueba(){
        return $this->service->prueba();
    }


}
