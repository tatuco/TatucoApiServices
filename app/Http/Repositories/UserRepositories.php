<?php

namespace App\Http\Repositories;

use App\Models\User;
use Optimus\Genie\Repository;


class UserRepository extends Repository
{
    public function getModel()
    {
        return new User();
    }

    public function create(array $data)
    {
        $user = $this->getModel();

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        $user->fill($data);
        $user->save();

        return $user;
    }

    public function update(User $user, array $data)
    {
        $user->fill($data);

        $user->save();

        return $user;
    }
    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     * consulta los  usuarios con sus roles
     */
    public function usersRoles()
    {
        $users = User::with('roles')->get();
        return $users;
    }

    /**
     * @return array retorna un json para crear un usuario
     */
    public function createJson()
    {
        return [
            "email"=> null,
            "name"=> null,
            "password"=> null
        ];
    }
}
