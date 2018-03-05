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
        //campo por el cual va a buscar el findTatuco
        $this->campo = 'use_dni';//llave primaria
        $this->status = 'use_act';//campo de activo o eliminado
        $this->validate = [//campo de validaciones
            'use_dni' => 'required|string',
            'use_nam' => 'required|string',
            'use_lna' => 'nullable',
            'email'    => 'required|email|unique:users',
            'use_nic'    => 'required|unique:users|min:6',
            'password'    => 'required|min:6'
        ];
    }

    //funcion que guarda los registros
    public function store(Request $request)
    {
        //llama a userService
        return $this->service->store($request, $this->validate);
    }

    //funcion que actualiza los registros
    public function update($dato, Request $request)
    {
        //llama a userService
      return $this->service->update($this->campo, $dato, $this->status, $request, $this->validate);
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
