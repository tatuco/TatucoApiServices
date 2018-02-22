<?php

namespace App\Http\Services\Gasolinera;
use App\Http\Services\Tatuco\TatucoService;
use App\Models\Gasolinera\Account;

class AccountService extends TatucoService
{

    public function __construct()
    {
        $this->name = 'Account';
        $this->model = new Account();
        $this->namePlural = 'Accounts';
    }

    public function store($request)
    {
        return $this->_store($request);
    }

    public function update($id, $request)
    {
        return $this->_update($id, $request);
    }

}