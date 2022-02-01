<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('view', 'users');

        $users = User::paginate();

        return UserResource::collection($users);
    }

    public function show($id)
    {
        Gate::authorize('view', 'users');

        $user = User::find($id);

        return new UserResource($user);
    }

    public function store(Request $request)
    {
        Gate::authorize('edit', 'users');

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'role_id' => 'required',
        ]);

        $user = User::create($request->only('first_name', 'last_name', 'email', 'role_id') + [
            'password' => Hash::make(123),
        ]);

        return response(new UserResource($user), Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('edit', 'users');

        $this->validate($request, [
            'email' => 'email|unique:users',
        ]);

        $user = User::find($id);

        $user->update($request->only('first_name', 'last_name', 'email', 'role_id'));

        return response(new UserResource($user), Response::HTTP_ACCEPTED);
    }

    public function destroy($id)
    {
        Gate::authorize('edit', 'users');

        User::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function user()
    {
        $user = Auth::user();

        return (new UserResource($user))->additional([
            'data' => [
                'permissions' => $user->permissions(),
            ],
        ]);
    }

    public function updateInfo(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|unique:users',
        ]);

        $user = Auth::user();

        $user->update($request->only('first_name', 'last_name', 'email'));

        return response($user, Response::HTTP_ACCEPTED);
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);

        $user = Auth::user();

        $user->update([
            'password' => Hash::make($request['password']),
        ]);

        return response($user, Response::HTTP_ACCEPTED);
    }
}
