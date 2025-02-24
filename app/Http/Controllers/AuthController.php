<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller {
    public function login(Request $request) {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (!Auth::attempt($validated)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $user = User::where('email', $validated['email'])->first();

            return response()->json([
                'message' => 'Login successful',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'token' => $user->createToken('auth_token')->plainTextToken
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Invalid credentials',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function verify(Request $request) {
        return response()->json([
            'message' => 'Valid token'
        ]);
    }

    public function logout(Request $request) {
        $request
            ->user()
            ->tokens()
            ->delete();

        return response()
            ->json([
                'message' => 'Successfully logged out'
            ]);
    }
}
