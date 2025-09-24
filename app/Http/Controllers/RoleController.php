<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a Role of the resource.
     */
    public function index(Request $request){
       return  Role::withCount('users')->latest()
            ->paginate(2)
            ->withQueryString();
    }

    public function show(Request $request) {
        return response()->json(Role::whereId($request->id)->with('users')->first());
    }

    public function rollAssgn(Request $request) {
        return response()->json($request->all());
        // $role = Role::findById($request->role_id)->first();
        // if(!!$role) {
        //     $role->syncPermissions($request->permissions);
        //     return response()->json(['message'=>'permissions assigned successfuly'],200);
        // }
        // return response()->json(['message'=>'not assigned'],500);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $role = $request->id? Role::whereId($request->id)->first() : new Role();

        $role->fill($request->validated());
        $role->save();
        $role->refresh();
        $role->users_count=$role->users()->count();

        return response()->json($role);
    }

  public function syncRole(Request $request, string $id) {
    //get user

    $role=Role::whereId($id)->first();

    if($role) $role->users()->sync($request->users);

    $role->refresh();

    return response()->json($role->users());

  }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id)->first();
        if(!!$role) {
            $role->delete();
            return response()->json(['message'=>'deleted successfuly'],200);
        }
        return response()->json(['message'=>'not deleted'],500);
    }
}
