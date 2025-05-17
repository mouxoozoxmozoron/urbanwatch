<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function DashboardHome(){
        return view('backend.pages.dashboard');
    }

    public function LoginCheck(Request $request){
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Logged in successfully!',
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Invalid email or password!',
            ], 401);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed!',
                // 'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred!',
                'error' => $e->getMessage(),
            ], 500);
        }
     }
}
