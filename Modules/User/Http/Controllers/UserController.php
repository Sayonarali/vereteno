<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\User\Http\Requests\UpdateUserRequest;
use Modules\User\Http\Responses\UserResponse;
use Modules\User\Services\UserService;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function show()
    {
        return new UserResponse($this->userService->show());
    }

    public function update(UpdateUserRequest $request)
    {
        return new UserResponse($this->userService->update($request->getDto()));
    }
}
