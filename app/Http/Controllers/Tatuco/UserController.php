<?php

namespace App\Http\Controllers\Tatuco;

use App\Http\Services\Tatuco\RoleService;
use App\Http\Services\Tatuco\UserService;
use App\Models\Tatuco\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends TatucoController
{
    //use RegistersUsers;

    /**
     * UserController constructor.
     * construimos los atributos que usara TatucoController
     */
    public $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->service = new UserService();
        $this->roleService = $roleService;
        //campo por el cual va a buscar el find
        $this->campo = 'use_dni';
        $this->status = 'use_sta';
    }

    //funcion que guarda los registros
    public function store(Request $request)
    {
        //llama a userService
        return $this->service->store($request);
    }

    //funcion que actualiza los registros
    public function update($dato, Request $request)
    {
        //llama a userService
      return $this->service->update($this->campo, $dato, $this->status, $request);
    }
    //funcion assigna roles
    public function assignedRole(Request $request)
    {
        $idUser = $request->json(['user']);
        $idRole = $request->json(['role']);
        if(!$user=User::find($idUser)){
            return response()->json([
                'status' => false,
                'message' => 'El usuario no Existe'
            ],404);
        }

        return $this->service->assignedRole($idUser, $idRole);
    }

    //funcion que quita los roles
    public function revokeRole(Request $request, $idUser, $idRole)
    {

        if($this->service->findByItem($idUser)) {
            if ($this->roleService->findByItem($idRole)){
                return $this->service->revokeRole($idUser, $idRole);
            }
            return $this->service->notFound();
        }else{
            return $this->service->notFound('Usuario');
        }
    }

    public function pruebaModel(){
        return (new User)->getModelTatuco();

    }


}
