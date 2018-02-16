<?php

namespace App\Http\Controllers\Tatuco;


use App\Acl\Src\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Services\Tatuco\PermissionService;

class PermissionController extends TatucoController
{
    

   public function __construct()
    {
        $this->service = new PermissionService();
    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function update($id, Request $request)
    {
      return $this->service->update($id, $request);
    }
}
