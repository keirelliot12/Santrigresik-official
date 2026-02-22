<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected OtpService $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required_without:otp_code|string',
            'otp_code' => 'required_without:password|string|size:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // OTP Login
        if ($request->has('otp_code')) {
            if (!$this->otpService->validateOtp($user, $request->otp_code)) {
                return response()->json([
                    'message' => 'Invalid or expired OTP code'
                ], 401);
            }

            $this->otpService->markAsVerified($user);
        }
        // Password Login
        else {
            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Invalid credentials'
                ], 401);
            }
        }

        // Skip email verification check for now
        // if (!$user->email_verified_at) {
        //     return response()->json([
        //         'message' => 'Email not verified'
        //     ], 403);
        // }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'login_method' => $request->has('otp_code') ? 'otp' : 'password',
            ],
            'token' => $token,
        ]);
    }

    public function requestOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$this->otpService->canResendOtp($user)) {
            return response()->json([
                'message' => 'Please wait 1 minute before requesting new OTP'
            ], 429);
        }

        if ($this->otpService->sendOtp($user, 'email')) {
            $this->otpService->markOtpSent($user);
            
            return response()->json([
                'message' => 'OTP sent to email successfully',
                'method' => 'email',
                'expires_in' => 300, // 5 minutes
            ]);
        }

        return response()->json([
            'message' => 'Failed to send OTP'
        ], 500);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successful'
        ]);
    }

    public function user(Request $request)
    {
        return response()->json([
            'user' => $request->user()->only(['id', 'name', 'email', 'phone', 'login_method'])
        ]);
    }
}