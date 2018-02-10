<?php

namespace App\Http\Controllers\Tatuco;


use App\Http\Controllers\Tatuco\TatucoController;
use App\Http\Services\Tatuco\UserService;
use App\Models\Tatuco\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Optimus\Bruno\EloquentBuilderTrait;
use Optimus\Bruno\LaravelController;


class UserController extends TatucoController
{
   // use RegistersUsers;

    /**
     * UserController constructor.
     * construimos los atributos que usara TatucoController
     */

    public function __construct()
    {
        $this->service = new UserService();
    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function update($id, Request $request)
    {
      return $this->service->update($id, $request)
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

    public function pruebaModel(){
        return (new User)->getModelTatuco();

    }

}
