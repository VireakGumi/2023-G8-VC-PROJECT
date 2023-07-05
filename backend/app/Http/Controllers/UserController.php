<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
    public function register(StoreRegisterRequest $request)
    {
        $credentails = $request->only('full_name', 'email', 'password');
        $credentails= Arr::add($credentails,'role_id',1);
        $credentails["password"] = bcrypt($credentails["password"]);

        $user = User::create($credentails);
        $token = $user->createToken('API Token', ['select', 'create', 'update'])->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Register account is successfully.',
            'token' => $token,
            'user' => $user
        ], 200);
    }
    public function login(StoreLoginRequest $request)
    {
        $credentails = $request->only('email', 'password');
        if (Auth::attempt($credentails)) {
            $user = Auth::user();
            $token = $user->createToken('API Token', ['select', 'create', 'delete', 'update'])->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => 'Login account is successfully.',
                'token' => $token,
                'user' => $user
            ], 200);
        }
        return Response()->json([
            'success' => false,
            'message' => 'Login credentails are invalid.',
        ], 404);
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return Response()->json([
            'success' => true,
            'message' => 'Logout is successfully.',
        ], 200);
    }
}