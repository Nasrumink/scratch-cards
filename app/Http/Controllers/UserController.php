<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

    /**
     * Fetch User
     * @param Request $request
     * @return User 
     */
    public function index(Request $request)
    {
        try {
            $users = User::filter($request->all())->get();
            return response()->json(["error" => false, "message" => "Success", "data" => $users], 200);
        } catch (\Throwable $th) {
            //Log the error and return apropriate message.
            return response()->json([
                'error' => true,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Fetch User
     * @param Request $request
     * @return User 
     */
    public function show(User $user)
    {
        try {
            return response()->json(["error" => false, "message" => "Success", "data" => $user], 200);
        } catch (\Throwable $th) {
            //Log the error and return apropriate message.
            return response()->json([
                'error' => true,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function store(UserRequest $request)
    {
        try {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'error' => false,
                'message' => 'User Created Successfully',
                //'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            //Log the error and return apropriate message.
            return response()->json([
                'error' => true,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update User
     * @param Request $request
     * @return User 
     */
    public function update(User $user,UserRequest $request)
    {
        try {
            $user->first_name = empty($request->first_name) ? $user->first_name : $request->first_name;
            $user->last_name = empty($request->last_name) ? $user->last_name : $request->last_name;
            $user->email = empty($request->email) ? $user->email : $request->email;
            $user->save();

            return response()->json([
                'error' => false,
                'message' => 'User Updated Successfully',
                'data' => $user
            ], 200);

        } catch (\Throwable $th) {
            //Log the error and return apropriate message.
            return response()->json([
                'error' => true,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(["error" => false, "message" => "User deleted successfully"], 200);
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'error' => true,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'error' => true,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'error' => false,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}