<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SignInAuthRequest;
use App\Http\Requests\Api\SignupAuthRequest;
use App\Http\Resources\Api\Auth\MeResource;
use App\Models\Setting;
use App\Models\User;
use App\Traits\ApiResponser;

class AuthController extends Controller
{
    use ApiResponser;

    public function signIn(SignInAuthRequest $request)
    {
        $credentials = $request->only(['user_name', 'password']);

        if (!auth()->attempt($credentials)) {
            return $this->respondBadRequest('Invalid credentials.', [
                'user_name' => 'User name or password is incorrect.',
                'password' => 'User name or password is incorrect.'
            ]);
        } else if (!auth()->user()->actived) {
            return $this->respondForbidden('Your account is not actived.');
        }

        /** @var \App\Models\User $user **/
        $user = auth()->user();
        $tokenResult = $user->createToken('Personal Access Token');

        return $this->respondSuccess([
            'token' => $tokenResult->plainTextToken
        ]);
    }

    public function signUp(SignUpAuthRequest $request)
    {
        $userData = $request->merge(['role' => 'member', 'avatar' => null, 'actvied' => false])->all();
        $user = User::create($userData);
        Setting::create([
            'user_id' => $user->id,
            'fixed_navbar' => true,
            'fixed_footer' => false
        ]);
        return $this->respondSuccess(new MeResource($user));
    }

    public function signOut()
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        $user->tokens()->delete();
        return $this->respondSuccess();
    }

    public function me()
    {
        $user = User::findOrFail(auth()->user()->id);
        return $this->respondSuccess(new MeResource($user));
    }
}
