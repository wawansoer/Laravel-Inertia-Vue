<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string|confirmed',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Successfully registered',
                'data' => $user,
            ], 200);

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json([
                'success' => false,
                'message' => 'Failed to register',
                'errors' => $errors,
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to register',
                'error' => $e->getMessage(),
            ], 500);
        }

    }

    public function login(Request $request)
    {

        try {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json(['message' => 'Invalid login credentials'], 401);
            }

            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Successfully login',
                'data' => $user,
                'token' => $token
            ], 200);

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json([
                'success' => false,
                'message' => 'Failed to login',
                'errors' => $errors,
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to login',
                'error' => $e->getMessage(),
            ], 500);
        }

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
