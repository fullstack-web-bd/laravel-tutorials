<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function checkDuplicateEmail(Request $request)
    {
        // Validation
        $request->validate([
            'email' => 'required|string|email'
        ]);

        $email = $request->email;

        // Check in DB if the email exists.
        $isEmailExist = User::where('email', $email)->exists();

        if ($isEmailExist) {
            return response([
                'status' => false,
                'message' => 'Duplicate email. Please try again with another email.'
            ]);
        }

        return response([
            'status' => true,
            'message' => 'Valid email.'
        ]);
    }
}
