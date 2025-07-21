<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Repot;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function loginProses(Request $request) {
        $request->validate([
            'email' =>'required|email:dns',
            'password' =>'required',
        ]);

        // Check if the user already exists
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            // If the user exists, attempt to log in
            if (Auth::attempt($request->only(['email', 'password']))) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->back()->with('failed', 'gagal login silahkan coba lagi');
            }
        } else {
            // If the user does not exist, create a new user and log in
            $newUser = User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            Auth::login($newUser);
            return redirect()->route('guest.dashboard_guest');
        }
    }

    
    public function index()
    {
        //
        $users = User::all();
        return view('headstaff.data_headstaff', compact('users'));
    }

    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $emailParts = explode('@', $user->email);
        $newPassword = implode('', array_slice(explode(' ', $emailParts[0]), 0, 4));
        $user->password = bcrypt($newPassword);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil direset');
    }

    public function diagram() {
        $headStaffProvinceId = Auth::user()->repots->first()->provinsi; // Assuming the user has a province_id attribute
        $report = Repot::where('3', $headStaffProvinceId)->count();
        $response = Repot::has('respon')->where('provinsi', $headStaffProvinceId)->count();

        return view('headstaff.diagram', compact('report', 'response'));
    }

    /**
     * Show the form for creating a new resource.
     */
    
    public function create()
    {
        //
        return view('headstaff.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->back()->with('success', 'Akun berhasil dibuat');
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
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'Akun sudah terhapus');
    }
}
