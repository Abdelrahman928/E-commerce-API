<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\VerificationRequest;
use Ichtrojan\Otp\Otp;
use Illuminate\Support\Facades\Auth;

class VerifyUserController extends Controller
{
    /**
    * verify user's email.
    *
    * @response 422 {
    *   "error": "validation errors"
    * }
    * @response 200 {
    *   "message": "email verified successfully"
    * }
    */
    public function verifyEmail(VerificationRequest $request){
        
        $user = Auth::user();
        $otpv = (new Otp)->validate($user->email, $request->otp);

        $isValid = $otpv->status;
        $message = $otpv->message;
        
            if(! $isValid)
            {
                return response()->json([
                    'status' => 403,
                    $message], 403);
            }
        $user->markEmailAsVerified();
        return response()->json([
            'status' => 200,
            'message' => 'email verified successfully'], 200);
    
    }

    /**
    * verify user's phone number.
    *
    * @response 422 {
    *   "error": "validation errors"
    * }
    * @response 200 {
    *   "message": "phone verified successfully"
    * }
    */
    public function verifyPhone(VerificationRequest $request){

        $user = Auth::user();
        $otpv = (new Otp)->validate($user->phone_number, $request->otp);

        if(! $otpv === $user->mobile_verify_code){
            return response()->json([
                'status' => 403,
                'the code you entered is invalid'], 403);
        }

        $user->markPhoneAsVerified();

        return response()->json([
            'status', 200,
            'message' => 'phone number verified successfully'], 200);
    }
}
