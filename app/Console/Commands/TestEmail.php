<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\OTPMail;

class TestEmail extends Command
{
    protected $signature = 'email:test {email}';
    protected $description = 'Test email configuration by sending a test OTP';

    public function handle()
    {
        $email = $this->argument('email');
        
        try {
            $user = User::where('email', $email)->first();
            if (!$user) {
                $user = new User([
                    'name' => 'Test User',
                    'email' => $email
                ]);
            }

            $testOTP = '123456';
            Mail::to($email)->send(new OTPMail($user, $testOTP));
            
            $this->info("✅ Test email sent successfully to: {$email}");
            $this->info("📧 Check your inbox for the OTP email");
            
        } catch (\Exception $e) {
            $this->error("❌ Failed to send email: " . $e->getMessage());
            $this->info("💡 Check your email configuration in .env file");
        }
    }
}