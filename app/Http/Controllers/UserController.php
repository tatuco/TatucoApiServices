<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TatucoController;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class UserController extends TatucoController
{
    use RegistersUsers;
    /**
     * UserController constructor.
     * construimos los atributos que usara TatucoController
     */
    public function __construct()
    {
        $this->name = 'user';
        $this->model = new User();
        $this->namePlural = 'users';
        //$this->paginate = 10;
    }

    public function store(Request $request)
    {
        $pass = bcrypt($request->json(['password']));
        $request->merge(['password' => $pass]);
        $this->request = $request;

        return $this->_store();
    }

    public function update($id, Request $request)
    {
        if($request->json(['password'])){
           $pass = bcrypt($request->json(['password']));
           $request->merge(['password' => $pass]);
        }
        $this->request = $request;
        return $this->_update($id);
    }
    public function assignedRole(Request $request)
    {
        try{
            $idUser = $request->json(['user']);
            $idRole = $request->json(['role']);
            $user=User::find($idUser);
            $user->assignRole($idRole);

            $user=User::find($idUser);
            $rolesAsigned=$user->getRoles();

            if($rolesAsigned){
                Log::info('Rol Asignado');
                return response()->json([
                    'status'=> true,
                    'msj'=> 'role asignado satisfactoriamente. ',
                    'rolesAsigned' => $rolesAsigned
                ], 200);
            }
        }catch (\Exception $e){
            Log::critical("Error, archivo del peo: {$e->getFile()}, linea del peo: {$e->getLine()}, el peo: {$e->getMessage()}");
            return response()->json(["msj"=>"Error de servidor"], 500);
        }
    }

    public function revokeRole(Request $request, $idUser, $idRole)
    {
        try{
            $user=User::find($idUser);
            if ($user->revokeRole($idRole)){
                $rolesAsigned=$user->getRoles();
                return response()->json([
                   'status' => true,
                   'msj' => 'Role revocado Satisfactoriamente',
                   'rolesAsigned' => $rolesAsigned
                ], 200);
            }else{
                return response()->json([
                   'status' => false,
                    'msj' => 'Error al revocar el rol',
                ], 500);
            }
        }catch(\Exception $e){
            Log::critical("Error, archivo del peo: {$e->getFile()}, linea del peo: {$e->getLine()}, el peo: {$e->getMessage()}");
            return response()->json(["msj"=>"Error de servidor"], 500);
        }

    }

    public function create(){
        return response()->json([
            'name' => 'string',
            'email' => 'string'
            ],200);
    }
}
