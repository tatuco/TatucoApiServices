<?php
namespace App\Http\Services;

use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Events\Dispatcher;
use App\Events\UserWasCreated;
use App\Http\Repositories\UserRepository;

class UserService
{
    private $auth;

    private $database;

    private $dispatcher;

    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function getAll($options = [])
    {
        return $this->userRepository->get($options);
    }

    public function getById($userId, array $options = [])
    {
        $user = $this->getRequestedUser($userId);

        return $user;
    }

    public function create($data)
    {
        $user = $this->userRepository->create($data);

        $this->dispatcher->fire(new UserWasCreated($user));

        return $user;
    }

    public function update($userId, array $data)
    {
        $user = $this->getRequestedUser($userId);

        $this->userRepository->update($user, $data);

        $this->dispatcher->fire(new UserWasUpdated($user));

        return $user;
    }

    public function delete($userId)
    {
        $user = $this->getRequestedUser($userId);

        $this->userRepository->delete($userId);

        $this->dispatcher->fire(new UserWasDeleted($user));
    }

    private function getRequestedUser($userId)
    {
        $user = $this->userRepository->getById($userId);

        if (is_null($user)) {
            throw new UserNotFoundException();
        }

        return $user;
    }


    public function createJson($options = [])
    {
        return $this->userRepository->createJson($options);
    }
}
