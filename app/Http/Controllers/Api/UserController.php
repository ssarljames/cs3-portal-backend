<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::query();

        if($request->q)
            $query->where(function($q) use ($request){
                $q->where('username', 'like', "$request->q%")
                ->orWhere('firstname', 'like', "%$request->q%")
                ->orWhere('lastname', 'like', "%$request->q%");
            });

        return $query->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'username' => 'required|min:4|max:50|unique:users,username',
            'password' => 'required|min:4|max:20',
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50'
        ];

        $request->validate($rules);

        $user = User::create($request->all());

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'username' => [
                'required',
                'min:4',
                'max:20',
                Rule::unique('users')->ignore($user->id)
            ],
            'password' => 'required_if:reset_password,1|min:5|max:20',
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50'
        ];

        $request->validate($rules);

        $user->update($request->only('firstname', 'lastname', 'username', 'reset_password', 'password'));

        return $user;


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
