<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller
{
    public function showLogin()
    {
        return view('cms.login');
    }
    public function login(PostAdminRequest $request)
    {

        //  $hashedPassword = Hash::make('12345678');
        // $hashedPassword = Hash::make('123456789');

        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];

        // if ($request->fails()) {
        //     return response()->json($request->messages(), Response::HTTP_BAD_REQUEST);
        // }
        if (Auth::guard('admin')->attempt($credentials, $request->get('remember_me'))) {
            // Auth::guard('admin')->user()->assignRole('normal admin');

            return response()->json(['message' => 'success'], 200);
        } else {
            return response()->json(['message' => 'Error credential'], 400);
        }
    }
    public function editProfile()
    {
    }
    public function updateProfile()
    {
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout(); // Logs out the authenticated user
        $request->session()->invalidate(); // Invalidates the session
        $request->session()->regenerateToken(); // Regenerates the CSRF token
        return redirect('/admin/login');
    }
}
