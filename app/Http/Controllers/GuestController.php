<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function guestLogin(Request $request) {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('pages.data_guest');
     }



    public function index(Request $request)
    {
        //

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
