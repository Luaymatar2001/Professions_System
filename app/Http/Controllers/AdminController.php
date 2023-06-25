<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Http\Requests\PostAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller
{
    public function elementEachPage()
    {
        return 10;
    }
    public function countNumRow($id)
    {
        # code...
        // $specialty = specialties::count();
        $index = Admin::pluck('id')->search($id);

        return $index;
    }

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

    public function create()
    {
        $this->authorize('create', Admin::class);
        return view('cms.admin.create')->with('type_admin', Admin::type_admin);
    }

    public function store(AdminRequest $request)
    {
        $this->authorize('create', Admin::class);
        $request['password'] = Hash::make($request['password']);
        $status = Admin::create($request->all());
        return redirect()->back()->with('status', $status);
    }
    public function index()
    {

        $this->authorize('viewAny', Admin::class);
        $data = Admin::paginate($this->elementEachPage());
        return view('cms.admin.index')->with('admins', $data);
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        $this->authorize('update', $admin);
        $admin = Admin::findOrFail($id);
        // $this->authorize('update',  $specialty);
        return response()->view('cms.admin.edit', ['admin' => $admin, 'type_admin' => Admin::type_admin]);
    }

    public function update(AdminRequest $request, $id)
    {
        // $request->except(['password']);
        $admin = Admin::findOrFail($id);

        $this->authorize('update',  $admin);
        $status = '';
        if (isset($request['password'])) {
            $request['password'] = Hash::make($request['password']);
            $status = $admin->update($request->all());
        } else {
            $status = $admin->update($request->only('name', 'email', 'role_name'));
        }
        return redirect()->back()->with('statusEdit', $status);
    }

    public function destroy(Admin $admin)
    {
        $this->authorize('delete', $admin);
        $status = $admin->delete();
        if (!$status) {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR, 'something went');
        } else {
            return back()->withSuccess("Deleted Successfully");
        }
    }
}
