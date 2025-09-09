<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Role::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = $request->id? Role::findById($request->id)->first() : new Role();

        $role->fill($request->validated());
        $role->save();
        $role->refresh();

        return response()->json($role);
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
