<?php

namespace App\Http\Controllers\Tatuco;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function api(){
        return response()->json([
            'title' => 'TatucoSystem',
            'descriptipn' => 'api de prueba en laravel'
        ], 200);
    }
}
