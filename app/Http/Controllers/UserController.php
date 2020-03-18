<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Http\Responses\SuccessWithData;
use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    public function store(SignupRequest $request)
    {
        $data = $request->all();
        $data['password'] = \Hash::make($data['password']);
        $user = User::create($data);
        return new SuccessResponse("User Created Successfully");
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
            return new ErrorResponse("User not found", 401);
        }
        return new SuccessWithData($user);
    }

    public function destroy($user_id)
    {
        try {
            User::findOrFail($user_id)->delete();
        } catch (\Exception $e) {
            return new ErrorResponse("User not found", 401);
        }
        return new SuccessResponse("User Deleted");
    }

    public function update($user_id, Request $request)
    {
        try {
            User::findOrFail($user_id)->update($request->except(['email', 'phone_number']));
        } catch (\Exception $e) {
            return new ErrorResponse("User not found", 401);
        }
        return new SuccessResponse("Details Updated");
    }
}
