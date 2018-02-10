<?php
namespace App\Http\Services\Tatuco;

use App\Models\Tatuco\User;
use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Events\Dispatcher;
use App\Events\UserWasCreated;
use App\Http\Services\Tatuco\TatucoService;



class UserService extends TatucoService
{
    public function __construct()
    {
        $this->name = 'user';
        $this->model = new User();
        $this->namePlural = 'users';
    }

    public function store($request){
        $pass = bcrypt($request->json(['password']));
        $request->merge(['password' => $pass]);
        $this->request = $request;

        return $this->_store($request);
    }
    public function update($id, $request)
    {
           if($request->json(['password'])){
           $pass = bcrypt($request->json(['password']));
           $request->merge(['password' => $pass]);
        }
        $this->request = $request;

        return $this->_update($id, $request);
    }
   
}
