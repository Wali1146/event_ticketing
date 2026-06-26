<?php

namespace App\Http\Controllers\API;

use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $this->service->getAll();

        return response()->json([
            'message' => 'Data user berhasil diambil',
            'data' => UserResource::collection($user),
        ], 200);
    }

    public function indexUser(Request $request)
    {
        $id = $request->user()->id;
        $user = $this->service->getId($id);

        return response()->json([
            'message' => 'Data user berhasil diambil',
            'data' => new UserResource($user),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $user = $this->service->store($data);

        return response()->json([
            'message' => 'User berhasil dibuat',
            'data' => new UserResource($user),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $user = $this->service->getId($id);

        return response()->json([
            'message' => 'Data berhasil diambil',
            'data' => new UserResource($user),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->validated();
        $user = $this->service->update($data, $id);

        return response()->json([
            'message' => 'User berhasil diupdate',
            'data' => new UserResource($user),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $user = $this->service->destroy($id);

        return response()->json([
            'message' => 'User berhasil dihapus',
            'data' => $user,
        ], 200);
    }
}
