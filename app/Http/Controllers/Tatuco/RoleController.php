<?php

namespace App\Http\Controllers\Tatuco;


use App\Acl\Src\Permission;
use App\Acl\Src\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Services\Tatuco\RoleService;

class RoleController extends TatucoController
{
     public function __construct()
    {
        $this->service = new RoleService();
    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function update($id, Request $request)
    {
      return $this->service->update($id, $request);
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
                    'message' => 'Permiso Asignado '
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
