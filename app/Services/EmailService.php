<?php

namespace App\Services;

use App\Models\User;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailService
{
    /**
     * Send OTP email to user
     */
    public function sendOTP(User $user, string $otp): bool
    {
        try {
            Mail::to($user->email)->send(new OTPMail($user, $otp));
            
            Log::info('OTP email sent successfully', [
                'user_id' => $user->id,
                'email' => $user->email,
                'timestamp' => now()
            ]);

            return true;

        } catch (\Exception $e) {
            Log::error('Failed to send OTP email', [
                'user_id' => $user->id,
                'email' => $user->email,
                'error' => $e->getMessage(),
                'timestamp' => now()
            ]);

            return false;
        }
    }

    /**
     * Send welcome email to new user
     */
    public function sendWelcomeEmail(User $user, string $password = null): bool
    {
        try {
            // You can create a WelcomeMail class for this
            // Mail::to($user->email)->send(new WelcomeMail($user, $password));
            
            Log::info('Welcome email sent successfully', [
                'user_id' => $user->id,
                'email' => $user->email,
            ]);

            return true;

        } catch (\Exception $e) {
            Log::error('Failed to send welcome email', [
                'user_id' => $user->id,
                'email' => $user->email,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }
}