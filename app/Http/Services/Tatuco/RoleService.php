<?php

namespace App\Http\Services\Tatuco;

use Caffeinated\Shinobi\Models\Role;

class RoleService extends TatucoService
{

	public function __construct()
    {
        $this->name = 'role';
        $this->model = new Role();
        $this->namePlural = 'roles';
    }

    //funcion que guarda registros
    public function index()
    {
        $resourceOptions = $this->parseResourceOptions();
        //realizo el query
        $query = $this->model::query();
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

    //funcion que guarda registros
    public function store($request)
    {
        //llama a tatucoService
    	return $this->_store($request);
    }

    //funcion que actualiza registros
    public function update($id, $request)
    {
        //llama a tatucoService
    	return $this->_update($id, $request);
    }
	
}