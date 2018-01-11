<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class TatucoController extends Controller
{
    public $model;
    public $object;
    public $name;
    public $namePlural;
    public $paginate = false;
    public $limit = null;
    public $data = [];
    public $request;
    /**
     * listar registros del objeto
     */
    public function index()
    {
        //iguala el nombre del objeto en plural a una variable
        $varname = $this->namePlural;
        //si la paginacion es true, recargamos la variable con el modelo para llamar al metodo paginate()
        if ($this->paginate)
        {
            $$varname = $this->model->paginate();
        }
        /**
         *  igualamos la data a lo que devuelva la funcion compact de php
         * la cual convierte en una matriz clave = valor
         * y retornamos la data en formato json
        */
        $this->data = compact($varname);

        if(!$this->data)
        {
            return response()->json([
                        "msj"=> "no hay registros"
            ], 200);
        }

        return response()->json([$this->data], 200);
    }
    /**
     * consultar un registro por id, el objeto sera el que se traiga el metodo find() que busca una registro
     * por id, si no existe enviamos la respuesta json con un mensaje y codigo
     * si existe retornamos el json con el objeto
     */
    public function show($id)
    {
        try{
            $this->object = $this->model->find($id);

            if(!$this->object)
            {
                return response()->json(['msj'=>$this->name. 'no existe'], 404);
            }
            Log::info('Encontrado');
            return response()->json([
                'status'=>true,
                'msj'=> $this->name. ' Encontrado',
                $this->name=>$this->object,
                200]);
        }catch (\Exception $e){
            Log::critical("Error, archivo del peo: {$e->getFile()}, linea del peo: {$e->getLine()}, el peo: {$e->getMessage()}");
            return response()->json(["msj"=>"Error de servidor"], 500);
        }
    }
    /**
     * guardar todo el request, pasamos la data al metodo create() del modelo
     * retornamos el objeto en formato json
     */
    public function _store()
    {
        try{
            if (count($this->data) == 0)
            {
                $this->data = $this->request->all();
            }
            $this->object = $this->model->create($this->data);

            Log::info('Guardado');
            return response()->json(['status'=>true,
                                    'msj'=>$this->name. 'Guardado',
                                    $this->name=>$this->object], 200);

        }catch (\Exception $e){
            Log::critical("Error, archivo del peo: {$e->getFile()}, linea del peo: {$e->getLine()}, el peo: {$e->getMessage()}");
            return response()->json(["msj"=>"Error de servidor"], 500);
        }
    }
    /**
     * actualizar un registro recibiendo el id buscandolo con el metodo findOrFail()
     *
     */
    public function _update($id)
    {
        try {
            $this->object = $this->model->findOrFail($id);

            if (count($this->data) == 0) {
                $this->data = $this->request->all();
            }

            $this->object->update($this->data);

            return response()->json([
                'error'=>false,
                'msj'=>$this->name. 'Modificado',
                $this->name=>$this->object
            ], 200);

        }catch(\Exception $e){
            Log::critical("Error, archivo del peo: {$e->getFile()}, linea del peo: {$e->getLine()}, el peo: {$e->getMessage()}");
            return response()->json(["msj"=>"Error de servidor"], 500);
        }
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
}
