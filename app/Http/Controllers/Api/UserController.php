<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = DB::select('select * from users');
        return response()->json($user);
    }

    public function indexUser(Request $request)
    {
        $id = $request->user()->id;
        $user = DB::select('select * from users where user_id = ?', [$id]);
        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, UserService $service)
    {
        $data = User::query()->find($id);
        $user = $service->get($data);
        if (is_array($user) && isset($user['message'])) {
            return response()->json($user);
        }
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, UserService $service)
    {
        $data = $request->validated();
        $id = User::query()->findOrFail($request->id);
        $user = $service->update($id, $data);
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, UserService $service)
    {
        $data = User::query()->find($id);
        $user = $service->delete($data);
        return response()->json($user);
    }
}
