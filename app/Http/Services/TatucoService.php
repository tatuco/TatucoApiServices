<?php

namespace App\Http\Services;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Optimus\Bruno\EloquentBuilderTrait;
use Optimus\Bruno\LaravelController;
use Tymon\JWTAuth\JWTAuth;

class TatucoService extends LaravelController
{
    use EloquentBuilderTrait;
    public $model;
    public $object;
    public $name;
    public $namePlural;
    public $paginate = false;
    public $limit = null;
    public $data = [];
    public $request;

    public function index(){
        $resourceOptions = $this->parseResourceOptions();
        $query = $this->model::query();
        $this->applyResourceOptions($query, $resourceOptions);
        $items = $query->get();

        // Parse the data using Optimus\Architect
        $parsedData = $this->parseData($items, $resourceOptions, $this->namePlural);

        /**
         *  igualamos la data a lo que devuelva la funcion compact de php
         * la cual convierte en una matriz clave = valor
         * y retornamos la data en formato json
         */
        //$this->data = compact($varname);

        if(!$this->response($parsedData))
        {
            return response()->json([
                "msj"=> "no hay registros"
            ], 200);
        }

        return response()->json($this->response($parsedData), 200);
    }
    public function show($id)
    {
        try{
            $resourceOptions = $this->parseResourceOptions();

            $this->data = $this->model::find($id);

            if(!$this->data)
            {
                return response()->json(['msj'=>$this->name. ' no existe'], 404);
            }
            $parsedData = $this->parseData($this->data, $resourceOptions, $this->name);

            Log::info('Encontrado');
            return response()->json([
                'status'=>true,
                'msj'=> $this->name. ' Encontrado',
                $this->name=> $this->response($parsedData),
            ], 200);
        }catch (\Exception $e){
            Log::critical("Error, archivo del peo: {$e->getFile()}, linea del peo: {$e->getLine()}, el peo: {$e->getMessage()}");
            return response()->json(["msj"=>"Error de servidor"], 500);
        }
    }
    public function _store($request)
    {
        try{
            if (count($this->data) == 0)
            {
               $this->data = $request->all();
            }

            Log::info('Guardado');
            if($this->object = $this->model->create($this->data)){
                return response()->json(['status'=>true,
                    'msj'=>$this->name. ' Guardado',
                    $this->name=>$this->object], 200);
            }

        }catch (\Exception $e){
            Log::critical("Error, archivo del peo: {$e->getFile()}, linea del peo: {$e->getLine()}, el peo: {$e->getMessage()}");
            return response()->json(['status'=>false,
                'msj'=> 'Error al Intentar Guardar '.$this->name
            ], 500);
        }
    }
    /**
     * listar registros del objeto
     */
   public function prueba(){
     return response()->json([
         'msj' => 'registros de usuarios',
         'model' => $this->name
     ],200);
   }

}
