<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\ChangePasswordRequest;
use App\Http\Requests\api\v1\ForgotPasswordRequest;
use App\Http\Requests\api\v1\VerificationRequest;
use App\Models\User;
use App\Notifications\SendVerifySMS;
use App\Notifications\VerifyEmailNotification;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForgotPasswordController extends Controller
{
    public function sendResetPasswordRequest(ForgotPasswordRequest $request){
        $contactInfo = $request->validated();

        $user = User::where(function ($query) use ($contactInfo) {
            $query->where('email', $contactInfo)
                  ->orWhere('phone_number', $contactInfo);
        })->first();

        $otp = (new Otp)->generate($contactInfo, 'numeric', '6', '5');
        if (filter_var($contactInfo, FILTER_VALIDATE_EMAIL)) {
            $user->notify(new VerifyEmailNotification($otp));
            $user->update(['email_verified_at' => null]);
        } else {
            $user->notify(new SendVerifySMS($otp));
            $user->update(['phone_verified_at' => null]);
        }

        $device = substr($request->userAgent() ?? ' ', 0, 255);
        return response()->json([
            'status' => 200,
            'message' => 'a verification code has been sent successfully',
            'acess_token' => $user->createToken($device, ['password:reset'], now()->addMinutes(5))->plainTextToken
        ], 200);
    }

    public function verify(VerificationRequest $request){
        $user = Auth::user();
        (new Otp())->validate($user->email || $user->phone_number, $request->otp);

        return response()->json([
            'status' => 200,
            'message' => 'please proceed to reset your password'
        ],200);
    }

    public function resetPassword(ChangePasswordRequest $request){
        $user = Auth::user();
        $newPassword = $request->validated(['new_password']);

        $user->update(['password' => $newPassword]);
        $user->tokens()->delete();

        return response()->json([
            'status' => 200,
            'message' => 'your password has been reset successfully'
        ], 200);
    }
}
