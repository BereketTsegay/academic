<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a Role of the resource.
     */
    public function index(Request $request)
    {
       return  Permission::latest()->paginate(6)->withQueryString();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        $permission = $request->id? Permission::findById($request->id)->first() : new Permission();

        $permission->fill($request->validated());
        $permission->save();
        $permission->refresh();

        return response()->json($permission);
    }

   
   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id)->first();
        if(!!$permission) {
            $permission->delete();
            return response()->json(['message'=>'deleted successfuly'],200);
        }
        return response()->json(['message'=>'not deleted'],500);
    }
}
