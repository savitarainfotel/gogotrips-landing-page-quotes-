<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VipSignup;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class JoinVipController extends Controller
{
    /**
     * Store a new VIP signup.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'countryCode' => ['nullable', 'string', 'max:10', 'regex:/^\+?\d+$/'],
            'phone' => ['nullable', 'string', 'max:20'],
        ];

        $validator = Validator::make($request->all(), $rules, [
            'name.required' => 'Full name is required.',
            'email.email' => 'Email must be a valid email address.',
            'countryCode.regex' => 'Country code must be a valid format (e.g., +1).',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $email = $request->input('email') ? trim($request->input('email')) : null;
        $phone = $request->input('phone') ? trim($request->input('phone')) : null;

        if (!$email && !$phone) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => [
                    'email' => ['Please provide either email or phone number.'],
                ],
            ], 422);
        }

        try {
            VipSignup::create([
                'name' => trim($request->input('name')),
                'email' => $email,
                'country_code' => $request->input('countryCode'),
                'phone' => $phone,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for joining the VIP list.',
            ], 201);
        } catch (\Exception $e) {
            Log::error('VIP signup failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['password', 'token']),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred. Please try again later.',
            ], 500);
        }
    }
}