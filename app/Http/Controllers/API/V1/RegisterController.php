<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\RegisterRequest;
use App\Http\Requests\api\v1\EnterPhoneRequest;
use App\Models\User;
use App\Notifications\SendVerifySMS;
use App\Notifications\VerifyEmailNotification;
use Ichtrojan\Otp\Otp;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
    * creates a new user.
    *
    * @response 422 {
    *   "error": "validation errors"
    * }
    * @response 200 {
    *   "message": "User created successfully. Verify your email to complete registration."
    *   "access_token": $token
    * }
    */
    public function registerUsingEmail(RegisterRequest $request){

        $user = User::create($request->validated());
            
        $otp = (new Otp())->generate($request->email , 'numeric', 6, 15);

        $user->notify(new VerifyEmailNotification($otp));

        $device = substr($request->userAgent() ?? ' ', 0, 255);

        return response()->json([
            'message' => 'User created successfully. Verify your email to complete registration.',200
            ,'access_token' => $user->createToken($device)->plainTextToken
        ]);
    }

    /**
    * user enters their phone number.
    *
    * @response 422 {
    *   "error": "validation errors"
    * }
    * @response 200 {
    *   "message": "Verify your phone number to complete registration."
    * }
    */
    public function enterPhone(EnterPhoneRequest $request){

        $user = Auth::user();
        $phone = $request->validated();
  
        $otp = (new Otp())->generate($phone , 'numeric', 6, 15);
        
        $user->update(['phone_number' => $phone]);
        $this->notify(new SendVerifySMS($otp));

        return response()->json(['message' => 'Verify your phone number.',200]);
    }
}
