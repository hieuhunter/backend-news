<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateProfileRequest;
use App\Http\Resources\Api\Auth\MeResource;
use App\Models\User;
use App\Traits\ApiResponser;

class ProfileController extends Controller
{
    use ApiResponser;

    public function show()
    {
        $user = User::findOrFail(auth()->user()->id);
        return $this->respondSuccess(new MeResource($user));
    }

    public function update(UpdateProfileRequest $request)
    {
        $userData = $request->only(['first_name', 'last_name', 'user_name', 'email', 'password', 'avatar']);
        $user = User::findOrFail(auth()->user()->id);
        $user->update($userData);
        return $this->respondSuccess(new MeResource($user));
    }
}
