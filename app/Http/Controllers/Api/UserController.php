<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

        $this->authorize('create', User::class);

        $rules = [
            'username' => 'required|min:3|max:50|unique:users,username',
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
        $this->authorize('update', $user);

        if($request->user()->is_administrator && $request->user()->id != $user->id){

            $rules = [
                'username' => [
                    'required',
                    'min:3',
                    'max:20',
                    Rule::unique('users')->ignore($user->id)
                ],
                'password' => 'required_if:reset_password,1|min:5|max:20',
                'firstname' => 'required|max:50',
                'lastname' => 'required|max:50'
            ];

            $request->validate($rules);

            $user->update($request->only('firstname', 'lastname', 'username', 'reset_password', 'password'));

        }
        else if($request->has('secure') && $request->user()->id == $user->id){

            $rules = [
                'new_password' => 'required|min:5|max:20',
                'confirm_new_password' => 'required|same:new_password'
            ];

            $request->validate($rules, [
                'new_password.required' => 'Required',
                'confirm_new_password.required' => 'Requied'
            ]);

            $user->update([
                'password' => bcrypt($request->new_password),
                'reset_password' => false
            ]);

        }
        else{
            $rules = [
                'username' => [
                    'required',
                    'min:3',
                    'max:20',
                    Rule::unique('users')->ignore($user->id)
                ],
                'new_password' => 'nullable|min:5|max:20',
                'confirm_new_password' => [
                    'same:new_password'
                ],
                'password' => 'required'
            ];

            $request->validate($rules);

            if($request->user()->checkPassword($request->password)){
                $user->username = $request->username;
                if($request->new_password)
                    $user->password = bcrypt($request->new_password);

                $user->save();
            }
            else
                return response()->json([
                    'message' => 'Authentication failed'
                ], 401);
        }



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
