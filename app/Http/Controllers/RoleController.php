<?php

namespace App\Http\Controllers;


use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleController extends TatucoController
{
    public function __construct()
    {
        $this->name = 'role';
        $this->model = new Role();
        $this->namePlural = 'roles';
        $this->paginate = 10;
    }

    public function store(Request $request)
    {

        $this->request = $request;

        return $this->_store();
    }

    public function update($id, Request $request)
    {

        $this->request = $request;
        return $this->_update($id);
    }

    public function assignedPermission(Request $request)
    {
        try{
            $roleId=$request->json(['role']);
            $permissionId=$request->json(['permission']);
            $rol=Role::find($roleId);
            $rol->assignPermission($permissionId);
          if($rol->save()){
                Log::info('Permiso Asignado');
                return response()->json([
                    'status' => true,
                    'msj' => 'Permiso Asignado '
                ], 200);
            }
        }catch (Exception $e){
            Log::critical("Error, archivo del peo: {$e->getFile()}, linea del peo: {$e->getLine()}, el peo: {$e->getMessage()}");
            return response()->json(["msj"=>"Error de servidor"], 500);
        }
    }
    public function revokePermission($idRole, $idPermission)
    {
        try{
            $role = Role::find($idRole);
            if($role->revokePermission($idPermission)){
                Log::info('Permiso Revocado');
                return response()->json([
                    'status' => true,
                    'msj' => 'Permiso Revocado '
                ], 200);
            }
        }catch (Exception $e){
            Log::critical("Error, archivo del peo: {$e->getFile()}, linea del peo: {$e->getLine()}, el peo: {$e->getMessage()}");
            return response()->json(["msj"=>"Error de servidor"], 500);
        }
    }
}
