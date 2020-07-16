<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Http\Responses\SuccessWithData;
use App\Http\Responses\SuccessWithToken;
use Illuminate\Http\Request;

use Tzsk\Otp\Facades\Otp;
use Carbon\Carbon;
use App\Traits\OtpTrait;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\User;

class UserController extends Controller
{
    use OtpTrait;

    public function store(SignupRequest $request)
    {
        $data = $request->all();
        $data['password'] = \Hash::make($data['password']);
        $user = User::create($data);
        $user->remember_token = \Str::random(6);
        $user->save();
        $data = $this->initiateOTP($user, 'OTP for verification has been sent to your phone_number');
        return new SuccessWithData($data);
    }

    public function verify(VerifyOtpRequest $request)
    {
        try {
            $user = User::findOrFail($request->user_id);
        } catch (\Exception $e) {
            return new ErrorResponse("User not found", 404);
        }

        if (Otp::digits(6)->expiry(15)->check($request['otp'], $user->remember_token)) {
            $user->phone_verified_at = Carbon::now();
            $user->remember_token = "";
            $user->save();
            $token = JWTAuth::fromUser($user);
            return new SuccessWithToken($token);
        } else {
            if (Carbon::now() > Carbon::parse($user->updated_at)->addMinutes(15) && $user->remember_token != null) {
                return new ErrorResponse("OTP Expired", 402);
            } else {
                return new ErrorResponse("Incorrect OTP", 403);
            }
        }
    }

    public function index()
    {
        return new SuccessWithData(User::all());
    }

    public function show($user_id)
    {
        try {
            $user = User::findOrFail($user_id);
        } catch (\Exception $e) {
            return new ErrorResponse("User not found", 404);
        }
        return new SuccessWithData($user);
    }

    public function destroy($user_id)
    {
        try {
            User::findOrFail($user_id)->delete();
        } catch (\Exception $e) {
            return new ErrorResponse("User not found", 404);
        }
        return new SuccessResponse("User Deleted");
    }

    public function update($user_id, Request $request)
    {
        try {
            $user = User::findOrFail($user_id)->update($request->except(['email', 'phone_number', 'password']));
        } catch (\Exception $e) {
            return new ErrorResponse("User not found", 404);
        }
        return new SuccessResponse("Details Updated");
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = auth()->user();

        $credentials['password'] = $request->current_password;
        $credentials['email'] = $user->email;

        if (!auth()->attempt($credentials)) {
            return new ErrorResponse("Wrong Password");
        }

        $data['password'] = \Hash::make($request->password);
        $user->update($data);

        return new SuccessResponse("Password Updated");
    }

    private function initiateOTP($user, $message)
    {
        $otp = Otp::digits(6)->expiry(15)->generate($user->remember_token);
        $data['expires_in'] = Carbon::Parse($user->updated_at)->addMinutes(15);

        $this->send("+91" . $user->phone_number, $message, $otp);

        $data['user_id'] = $user->id;
        $data['message'] = "OTP has been sent to phone number";

        return $data;
    }


    // web

    public function webIndex()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function webDestroy($id)
    {
        User::find($id)->delete();
        return back();
    }
}
