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
    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function update($id, Request $request)
    {
      return $this->service->update($id, $request);
    }
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
