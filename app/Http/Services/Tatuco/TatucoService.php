<?php

namespace App\Http\Services\Tatuco;

use App\Http\Requests\UserRequest;
use App\Models\Tatuco\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Optimus\Bruno\EloquentBuilderTrait;
use Optimus\Bruno\LaravelController;
use Tymon\JWTAuth\JWTAuth;
use Carbon\Carbon;
use App\Http\Services\Tatuco\ReportService;

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
    public $dato;
    public $reportService;

    /** token de sysadmin eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvbG9naW4iLCJpYXQiOjE1MTg0NzM5MjYsImV4cCI6MTUxODQ3NzUyNiwibmJmIjoxNTE4NDczOTI2LCJqdGkiOiIwQ2RBZ1JPS3N6ZFR1ZU1DIn0.4X9UtMLM5EwrLG_aSZ_3QEZ4oK0IZgbnMwoTpQUmmd0
     * @return \Illuminate\Http\JsonResponse
     * consultar todos los registros de un modelo
     * uso de parseresource y applyresource para el uso de los parametros
     * incude[] limits sorts etc ...
     * leer paquetes
     */
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    //funcion que consulta y muestra todos los datos, depende del estatus y el account
    public function _index($status){
        //consulto los permisos
        if (($this->checkPermission('index.'.$this->name)) == false ) {
            return response()->json([
                'status'=> false,
                'message' => 'no tienes permiso index.'.$this->name
            ],403);
        }
        $resourceOptions = $this->parseResourceOptions();

        //consulto los datos del que esta loggueado
        $user = \JWTAuth::parseToken()->authenticate();
        //assigno a account el dato del campo
        $account = 'acc_id';
        //realizo el query con el where: status=true y account=id de la cuenta registrada
        $query = $this->model::query()->where($status,true)->where($account,$user->acc_id);
        $this->applyResourceOptions($query, $resourceOptions);
        $items = $query->get();

        $parsedData = $this->parseData($items, $resourceOptions, $this->namePlural);
        //si el query no devuelve nada
        if(!$this->response($parsedData))
        {
            return response()->json([
                "message"=> "no hay registros"
            ], 200);
        }

        //si consigue algo devuelve los datos
        return response()->json($parsedData, 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * consultar un registro por medio de un id
     */
    public function _show($campo, $dato, $status)
    {
        try{
            //consulto los permisos
            if (($this->checkPermission('show.'.$this->name)) == false ) {
                return response()->json([
                    'status'=> false,
                    'message' => 'no tienes permiso para => show.'.$this->name
                ],403);
            }

            $resourceOptions = $this->parseResourceOptions();
            //llamo al findtatuco que filtra por cuenta y status
            $this->data = $this->findTatuco($campo, $dato, $status);
            //si no consigue nada delvuelve 404
            if(!$this->data)
            {
                return response()->json(['message'=>$this->name. ' no existe'], 404);
            }
            $parsedData = $this->parseData($this->data, $resourceOptions);

            Log::info('Encontrado');
            //si consigue, arma el json
            return response()->json([
                'status'=>true,
                'message'=> $this->name. ' Encontrado',
                $this->name => $parsedData,
            ], 200);
            //si ocurre alguna exception la devuelve
        }catch (\Exception $e){
            Log::critical("Error, archivo del peo: {$e->getFile()}, linea del peo: {$e->getLine()}, el peo: {$e->getMessage()}, codigo del peo: {$e->getCode()}");
            return response()->json([
                "message"=>"Error de servidor",
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'code' => $e->getCode()
            ], 500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonRespon
     * guardar un registro nuevo
     */
    public function _store(Request $request)
    {
        try{
            //consulto los permisos
            if (($this->checkPermission('store.'.$this->name)) == false ) {
                return response()->json([
                    'status'=> false,
                    'message' => 'no tienes permiso para => store.'.$this->name
                ],403);
            }

            if (count($this->data) == 0) {
                $this->data = $request->all();
            }
            //si todo es correcto, guarda los datos

            Log::info('Guardado');
            if($this->object = $this->model::create($this->data)){
                return response()->json(['status'=>true,
                    'message'=>$this->name. ' Guardado',
                    $this->name=>$this->object],
                    201);
            }

            //si salta una exception la procesa
        }catch (\Exception $e){
            Log::critical("Error, archivo del peo: {$e->getFile()}, linea del peo: {$e->getLine()}, el peo: {$e->getMessage()}");
            return response()->json(['status'=>false,
                'message'=> 'Error al Intentar Guardar '.$this->name,
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'code' => $e->getCode()
            ], 500);
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * acualizar registro
     */
    public function _update($campo, $dato, $status, Request $request)
    {
        try {
            //consulto los permisos
            if (($this->checkPermission('update.'.$this->name)) == false ) {
                return response()->json([
                    'status'=> false,
                    'message' => 'no tienes permiso para => update.'.$this->name
                ],403);
            }

            //llamo al filtro por account y id
            $this->object = $this->findTatuco($campo, $dato, $status);
            if (count($this->data) == 0) {
                $this->data = $request->all();
            }

            $this->object->update($this->data);

            return response()->json([
                'startus'=>true,
                'message'=>$this->name. ' Modificado',
                $this->name=> $this->object
            ], 200);

        }catch(\Exception $e){
            Log::critical("Error, archivo del peo: {$e->getFile()}, linea del peo: {$e->getLine()}, el peo: {$e->getMessage()}");
            return response()->json(['status'=>false,
                'message'=> 'Error al Intentar Guardar '.$this->name,
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'code' => $e->getCode()
            ], 500);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * metodo para eliminar un registro
     */
    public function _destroy($campo, $dato, $status)
    {
        try {
            //consulto los permisos
            if (($this->checkPermission('delete.'.$this->name)) == false ) {
                return response()->json([
                    'status'=> false,
                    'message' => 'no tienes permiso para => delete.'.$this->name
                ],403);
            }

            //llamo al filtro por account y id
            $this->object = $this->findTatuco($campo, $dato, $status);
            //si el objeto es nulo, no existe la busqueda
            if (!$this->object) {
                return response()->json([
                    'message' => $this->name . ' no existe'
                ], 404);
            }
            //iguala el estatus a false = eliminado
            $this->object->$status = false;
            //$this->object->disable = true;
            //$this->object->delete();
            $this->object->update();
            return response()->json([
                'status' => true,
                'message' => $this->name . ' Eliminado'
            ], 206);
        }catch (\Exception $e){
            Log::critical("Error, archivo del peo: {$e->getFile()}, linea del peo: {$e->getLine()}, el peo: {$e->getMessage()}");
            return response()->json(["message"=>"Error de servidor",], 500);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * metodo para realizar respaldo a la base de datos
     * llamando al comando schedule:run de laravel
     * para que ejecute las tareas pendientes
     */
    public function backup()
    {

        try {
            if((\Artisan::call('schedule:run', array()))==0){
                return response()->json([
                    'status' => true,
                    'message' => 'Backup Existoso'
                ],200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Backup Fallido'
                ],500);
            }
        }catch (\Exception $e){
            Log::critical("Error, archivo del peo: {$e->getFile()}, linea del peo: {$e->getLine()}, el peo: {$e->getMessage()}");
            return response()->json(["message"=>"Error de servidor"], 500);
        }
    }

    /**
     * listar registros del objeto
     */
    public function prueba(Request $request){
        return response()->json([
            'message' => 'registros de usuarios',
            'model' => $this->name?:null,
            'request' => $request
        ],200);
    }

    public function createJson(){
        return $this->model->createJson();
    }

    /**
     * @param $id
     * @return bool
     * metodo para verificar si un registro existe o no
     * con el fin de devolver una respues de no encontrado
     */
    public function findByItem($id)
    {
        if(!$this->model->find($id))
            return false;
        else
            return true;
    }

    /**
     * @param null $item
     * @return \Illuminate\Http\JsonResponse
     * respuesta de no encontrado en formato json
     * puede recibir un string para escificar que cosa no se encontro
     */
    public function notFound($item = null)
    {
        return response()->json([
            'message'=> $item.' No Encontrado'
        ],404);
    }

    public function report(Request $request, $columns)
    {
        return (new ReportService)->report($request, $this->model, $this->namePlural, $columns);
        //return response()->json(['modelo' => $this->model->all()]);
    }


    //filtro por acccount y status = 1: activo
    public function findTatuco($column, $dato, $status, $columns = ['*'])
    {
        //consulto al que esta logueado
        $user = \JWTAuth::parseToken()->authenticate();
        $account = 'acc_id';
        return $this->model->where($column, '=', $dato)
            ->where($status,'=',true)
            ->where($account,'=',$user->acc_id)
            ->first($columns);
    }

    //metodo que consulta los permisos
    public function checkPermission($permissions)
    {

        if (!\JWTAuth::parseToken()->authenticate()->can($permissions)) {

            return false;
        }

        return true;
    }
}
