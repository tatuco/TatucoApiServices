<?php

namespace App\Http\Controllers\Tatuco;

use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Services\Tatuco\PermissionService;

class PermissionController extends TatucoController
{
    

   public function __construct()
    {
        $this->service = new PermissionService();
    }
    //guarda datos
    public function store(Request $request)
    {
        //envia datos a permissionService
        return $this->service->store($request);
    }

    //actualiza datos
    public function update($id, Request $request)
    {
        //envia datos a permissionService
        return $this->service->update($id, $request);
    }
}
