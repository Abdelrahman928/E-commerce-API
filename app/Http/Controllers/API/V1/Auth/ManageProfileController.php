<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\ChangePasswordRequest;
use App\Http\Requests\api\v1\EmailLoginRequest;
use App\Http\Requests\api\v1\EnterPhoneRequest;
use App\Http\Requests\api\v1\ShippingAddressRequest;
use App\Http\Requests\api\v1\UserPaymentMethodRequest;
use App\Http\Requests\api\v1\VerificationRequest;
use App\Http\Resources\api\v1\ShippingAddressResource;
use App\Http\Resources\api\v1\UserPaymentMethodResource;
use App\Http\Resources\api\v1\UserResource;
use App\Models\ShippingAddress;
use App\Models\UserPaymentMethod;
use App\Notifications\SendVerifySMS;
use App\Notifications\VerifyEmailNotification;
use Ichtrojan\Otp\Otp;
use Illuminate\Support\Facades\Auth;

class ManageProfileController extends Controller
{
    public function show(){
        $user = Auth::user();

        return new UserResource($user);
    }

    public function changeEmail(EmailLoginRequest $request){
        $user = Auth::user();

        $newEmail = $request->validated('email');

        $user->update(['email'=> $newEmail]);
        $otp = (new Otp())->generate($request->email , 'numeric', 6, 5);
        $user->notify(new VerifyEmailNotification($otp));

        return response()->json([
            'status' => 200,
            'message' => 'Email updated successfully, please verify your email'
        ], 200);
    }

    public function changePassword(ChangePasswordRequest $request){
        $user = Auth::user();
        $newPassword = $request->validated();

        if($user->password !== $newPassword->current_password){
            return response()->json([
                'status' => 422,
                'error' => 'you entered a wrong password'
            ], 422);
        }

        $user->update(['password' => $newPassword->new_password]);

        return response()->json([
            'status' => 200, 
            'message' => 'password updated successfully'
        ], 200);
    }

    public function verifyDleletePhone(){
        $user = Auth::user();
        $userPhone = $user->phone_number;
        
        $otp = (new Otp())->generate($userPhone, 'numeric', '6', '5');
        $user->notify(new SendVerifySMS($otp));
    }

    public function deletePhone(VerificationRequest $request){
        $user = Auth::user();
        $otp = $request->validated();
        (new Otp())->validate($user->phone_number, $otp->code);

        $user->phone_number = null;
        $user->save();

        return response()->json([
            'status' => 200,
            'message' => 'phone number removed successfully'
        ], 200);
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
    public function addPhone(EnterPhoneRequest $request){
        $user = Auth::user();
        $phone = $request->validated();
  
        $otp = (new Otp())->generate($request->phone_number , 'numeric', 6, 15);
        $user->notify(new SendVerifySMS($otp));
        
        $user->update(['phone_number' => $phone]);
        $this->notify(new SendVerifySMS($otp));

        return response()->json([
            'status' => 200,
            'message' => 'Verify your phone number.'], 200);
        }

    public function verifyPhone(VerificationRequest $request){
        $user = Auth::user();
        (new Otp())->validate($user->phone_number, $request->code);

        $user->markPhoneAsVerified();

        return response()->json([
            'status' => 200,
            'message' => 'Phone number verified successfully'
        ], 200);
    }

    public function indexShippingAddresses(){
        $user = Auth::user();
        $shipping = $user->shippingAddress()->get();

        if($shipping->isEmpty()){
            return response()->json([
                'status' => 404,
                'message' => 'Add your address.'
            ], 404);
        }

        return ShippingAddressResource::collection($shipping);
    }

    public function createShippingAddress(ShippingAddressRequest $request){
        ShippingAddress::create($request->validated());

        return response()->json([
            'status' => 200,
            'message' => 'Shipping address added successfully'
        ], 200);
    }

    public function indexPaymentMethods(){
        $user = Auth::user();
        $userPaymentMethod = UserPaymentMethod::where('user_id', $user->id)->get();

        if ($userPaymentMethod->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'Add your payment method.'], 404);
        }

        return UserPaymentMethodResource::collection($userPaymentMethod);
    }

    public function addPaymentMethod(UserPaymentMethodRequest $request){
        $data = $request->validated();
        unset($data['CVV']);
        UserPaymentMethod::create($data);

        return response()->json([
            'status' => 200,
            'message' => 'Payment method added successfully'], 200);
    }
}
