<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegister;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          return  User::with(['roles','permissions'])->latest()
            ->paginate(2)
            ->withQueryString();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRegister $request)
    {
        $user = User::whereId($request->id)->first();
        if(!$user) return response()->json('Pls register new',403);

        $user->fill($request->validated());
        $user->save();

        return response()->json($user,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function search(Request $request)
    {
        $query = User::query();
        $query->where('name','like',"%{$request->q}%");
        return response()->json($query->get());
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
