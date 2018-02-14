<?php

namespace App\Http\Controllers\Inventary;

use Illuminate\Http\Request;
use App\Http\Controllers\Tatuco\TatucoController;
use App\Http\Services\Inventary\ClientService;

class ClientController extends TatucoController
{
      public function __construct()
    {
        $this->service = new ClientService();
        $this->columns = [
          'Cedula' => 'id',
          'Nombre' => 'title'
        ];
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
