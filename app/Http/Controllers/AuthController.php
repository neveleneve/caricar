<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller {

    /* 
        Handles user login using email and password.
        @param Request $request The incoming request containing the user's email and password.
        @return \Illuminate\Http\JsonResponse The response containing the user's data and token upon successful login.
        @throws ValidationException If the provided credentials are incorrect.
        @throws Exception If an unexpected error occurs during the login process.
    */
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
                    'role' => $user->roles()->first()?->name ?? 'no role',
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

    public function loginWithFacebook(Request $request) {
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'facebook_id' => $request->facebook_id,
                    'password' => Hash::make(Str::random(24))
                ]);
                $user->assignRole('pengguna');
            }

            return response()->json([
                'message' => 'Login successful',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->roles()->first()?->name ?? 'no role',
                ],
                'token' => $user->createToken('auth_token')->plainTextToken
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Facebook login failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function loginWithGoogle(Request $request) {
        try {
            // Add validation
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'google_id' => 'required|string'
            ]);

            $user = User::where('email', $validated['email'])->first();

            if (!$user) {
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'google_id' => $validated['google_id'],
                    'password' => Hash::make(Str::random(24))
                ]);
                $user->assignRole('pengguna');
            }

            return response()->json([
                'message' => 'Login successful',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->roles()->first()?->name ?? 'no role',
                ],
                'token' => $user->createToken('auth_token')->plainTextToken
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Invalid data provided',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Google login failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
