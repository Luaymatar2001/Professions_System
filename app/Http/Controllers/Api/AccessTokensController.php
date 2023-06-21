<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class AccessTokensController extends Controller
{
    //
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email|max:255',
                'password' => 'required|string|max:255',
                'device_name' => 'string|max:255',
                // 'abilities' =>'required'

            ],
        );
        if (!$validator->fails()) {
            // $password = Hash::make('123456');
            $user = User::where('email', $request->email)->first();
            // ->orWhere('mobile', $request->username)
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Invalid username and password combination',
                    // 'pass' => $password
                ], 401);
            }
            //إذا لم يتم إرجاع أسم الجهاز يتم إنشاءه من طرف الباك
            // post :return value from body of post request
            $device_name = $request->post('device_name', $request->userAgent());
            $token = $user->createToken($device_name);
            $abilities = $request->input('abilities', ['*']);
            if ($abilities && is_string($abilities)) {
                $abilities = explode('.', $abilities);
            }
            return response()->json([
                'token' => $token->plainTextToken,
                'user' => $user,

            ], 201);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], 400);
        }
    }
    public function destroy($token = null)
    {
        //get current user
        $user = Auth::guard('sanctum')->user();

        if (null === $token) {
            $user->currentAccessToken()->delete();
            return;
        }
        //get object user Token from DB 
        $personalAccessToken = PersonalAccessToken::findToken($token);
        // chech if current user equal the user token that get from DB
        //and same class model
        if (
            $user->id == $personalAccessToken->tokenable_id &&
            $personalAccessToken->tokenable_type == get_class($user)
        ) {
            //delete from DB the Token
            $personalAccessToken->delete();
        }
        return response()->json([
            'success' => $user
        ], 201);
    }
}
