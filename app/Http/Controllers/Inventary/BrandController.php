<?php

namespace App\Http\Controllers\Inventary;

use Illuminate\Http\Request;
use App\Http\Controllers\Tatuco\TatucoController;
use App\Http\Services\Inventary\BrandService;

class BrandController extends TatucoController
{
     public function __construct()
    {
        $this->service = new BrandService();
        $this->columns = [
        'Id' => 'id',
        'Codigo' => 'code',
        'Marce' => 'title',
        'Fecha Creacion' => 'created_at',
        'Fecha Actualizacion' => 'updated_at'
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
