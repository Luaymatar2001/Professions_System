<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function elementEachPage()
    {
        return 10;
    }
    public function countNumRow($id)
    {
        # code...
        // $specialty = specialties::count();
        $index = User::pluck('id')->search($id);

        return $index;
    }

    public function validat($requests)
    {
        $validator = Validator::make(
            $requests->all(),
            [
                'name' => 'required|string',
                'email' => 'required|email|string',
                'permission' => 'required|string',

            ],
            [
                'name.required' => 'the name of user is required',
                'name.string' => 'the name of user must be string',

                'email.required' => 'the email of user is required',
                'email.email' => 'the email of user must be email',
                'email.string' => 'the email of user must be string',

                'email.required' => 'the email of user is required',
                'email.string' => 'the email of user must be string',

            ]

        );
        return $validator;
    }

    public function create()
    {
        return view('cms.users.create');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::withCount('permissions')->paginate($this->elementEachPage());

        return view('cms.users.index')->with('users', $users);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
