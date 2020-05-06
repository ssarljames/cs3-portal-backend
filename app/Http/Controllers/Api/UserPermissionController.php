<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserPermissionResource;
use App\User;
use App\UserPermission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UserPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return UserPermissionResource::collection($user->permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @param  \App\UserPermission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, $permission)
    {
        return $user->userPermission;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @param  \App\UserPermission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, $permission)
    {
        $rule = [
            'to_add.*' => [
                'nullable',
                Rule::in(array_keys(UserPermission::TYPES))
            ],
            'to_remove.*' => [
                'nullable',
                Rule::in(array_keys(UserPermission::TYPES))
            ]
        ];

        

        $data = $request->validate($rule);


        try{
            DB::beginTransaction();

            if(isset($data['to_add']))
                foreach ($data['to_add'] as $type) {
                    $user->permissions()->create([
                        'permission' => $permission,
                        'type' => $type,
                        'granted_by_user_id' => $request->user()->id
                    ]);
                }

            if(isset($data['to_remove']))
                $user->permissions()
                        ->where('permission', $permission)
                        ->whereIn('type', $data['to_remove'])
                        ->delete();

            DB::commit();

        }catch(Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }

        return [
            'message' => 'ok',
            'data' => []
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @param  \App\UserPermission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $permission)
    {
        //
    }

    public function getTypes(){
        return [
            'data' => UserPermission::TYPES
        ];
    }
    public function getAllPermissions(User $user){
        
        $permissions = UserPermission::PERMISSIONS;

        $existing = $user->permissions()->select('permission')->distinct()->get()->toArray();


        $existing = array_values($existing);

        $permissions = array_filter($permissions, function($value, $key) use($existing){

            $exist = false;

            foreach ($existing as $e) {
                $exist |= $e['permission'] == $key;
            }

            return $exist == false;


        }, ARRAY_FILTER_USE_BOTH);

        return [
            'data' => $permissions
        ];
    }
}
