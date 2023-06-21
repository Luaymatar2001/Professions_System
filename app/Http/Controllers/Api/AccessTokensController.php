<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
    public function register(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            "name" => ["required", "string"],
            "email" => ['required', 'unique:users,email'],
            "password" => ['required', 'min:8', 'confirmed'],
            'image' => 'nullable|base64image',
        ], [
            "name.required" => "Name is required.",
            "email.required" => "Email is required.",
            "email.unique" => "This email already exists in our database!",
            "password.required" => "<PASSWORD> is required.",
            "password.min" => "The password must be at least 8",
            "password.confirmed" => "must confirmed the password",
            'image.base64image' => "the image must store Base64",
        ]);
        $data_request = $request->all();
        $base64 = $data_request['image'];
        if (!$base64) {
            return response()->json(['error' => 'Please enter a base64 image string.']);
        }
        //  This line of code uses a regular expression to remove the image format and base64 encoding prefix from a string representing an image encoded in base64 format.
        $base64 = preg_replace("/^data:image\/(png|jpeg|jpg|svg|gif);base64,/", '', $base64);
        //decode from base64 image
        $data = base64_decode($base64);
        $imageSize = getimagesizefromstring($data);
        $path = "project_img/user_img/";
        $name = time() + rand(1, 1000) . "." . explode("/", $imageSize['mime'])[1];
        Storage::disk('local')->put($path . $name,  $data);

        if (!$validator->fails()) {
            return response()->json($validator->getMessageBag()->first(), 422);
        }
        $request['password'] = Hash::make($request['password']);
        $data_request['image'] = $path . $name;

        $result = $user->create($data_request);

        return response()->json(['message' => 'Registration successful', 'status' => $result, 'image' => storage_path('app/' . $result->image)], 200);
    }
}
