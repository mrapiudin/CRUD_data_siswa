<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class KelolaSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $user = User::where('name', 'LIKE', '%'.$request->cari.'%')->simplePaginate(5)->appends($request->all());
        return view('pages.kelola_siswa', compact('user')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('kelola.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|max:100',
            'pengurus' => 'required',
            'tingkat' => 'required'
            // 'password' => 'required'
        ], [
            'name.required' => 'Nama harus di isi!',
            'name.max' => 'Nama obat maksimal 100 karakter',
            'pengurus.required' => 'jenis pengurus harus diisi',
            'tingkat.required' => 'tingkatan kelas harus di isi!',
        ]);

        User::create($request->all());


        return redirect()->route('kelola_siswa.siswa')->with('success', 'Berhasil Menambah Data Obat!');
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
        $user = User::find($id);
        return view('kelola.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|max:100',
            'pengurus' => 'required',
            'tingkat' => 'required',
            // 'password' => 'nullable',
        ]);

        $user= User::find($id);

        $user->update([
            'name' => $request->name,
            'pengurus' => $request->pengurus,
            'tingkat' => $request->tingkat,
            // 'password' => $request->password ?? $user->password
        ]);

        return redirect()->route('kelola_siswa.siswa')->with('success', 'Berhasil Menambah Data Obat!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        User::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
