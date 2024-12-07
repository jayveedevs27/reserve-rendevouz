<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Handle login for admins.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function adminLogin(Request $request)
    {
        // Validate incoming login credentials
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Attempt login with the provided credentials
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Check if the user is an admin
            if ($user->is_admin) {
                return response()->json([
                    'message' => 'Login successful',
                    'user' => $user,
                ], 200);
            }

            // Logout non-admin users
            Auth::logout();
            return response()->json([
                'message' => 'Access denied. Admins only.',
            ], 403);
        }

        // Login failed
        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }
}

