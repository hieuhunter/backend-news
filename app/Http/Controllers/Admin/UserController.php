<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Resources\Admin\User\UserResource;
use App\Http\Resources\Admin\User\UserCollection;
use App\Models\Setting;
use App\Models\User;
use App\Traits\ApiResponser;

class UserController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $users = new User();
        if ($request->filled('q')) {
            $users = $users->where(DB::raw('CONCAT_WS(" ", first_name, last_name)'), 'LIKE', '%' . $request->q . '%')
                ->orWhere(DB::raw('CONCAT_WS(" ", last_name, first_name)'), 'LIKE', '%' . $request->q . '%')
                ->orWhere('user_name', 'LIKE', '%' . $request->q . '%')
                ->orWhere('email', 'LIKE', '%' . $request->q . '%');
        }
        $usersCount = $users->get()->count();
        $users = $users->pagination();
        return $this->respondSuccessWithPagination(new UserCollection($users), $usersCount);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return $this->respondSuccess(new UserResource($user));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
        $userData = $request->all();
        $user = User::create($userData);
        Setting::create([
            'user_id' => $user->id,
            'fixed_navbar' => true,
            'fixed_footer' => false
        ]);
        return $this->respondSuccess(new UserResource($user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $userData = $request->all();
        $user = User::findOrFail($id);
        if (auth()->user()->id === $user->id) {
            return $this->respondForbidden('You cannot update your own profile.');
        }
        $user->update($userData);
        return $this->respondSuccess(new UserResource($user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (auth()->user()->id === $user->id) {
            return $this->respondForbidden('You cannot delete your own profile.');
        }
        $user->delete();
        return $this->respondSuccess(new UserResource($user));
    }
}
