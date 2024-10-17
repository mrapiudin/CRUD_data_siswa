<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $student = Student::where('name', 'LIKE', '%'.$request->cari.'%')->simplePaginate(5)->appends($request->all());
        return view('pages.data_siswa' , compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|max:100',
            'gender' => 'required',
            'rombel' => 'required',
            'rayon' => 'required'
        ], [
            'name.required' => 'Nama harus di isi!',
            'name.max' => 'Nama obat maksimal 100 karakter',
            'gender.required' => 'jenis kelamin harus di pilih',
            'rombel.required' => 'Bagian harus di isi',
            'rayon.required' => 'Bagian harus di isi',
        ]);

        Student::create($request->all());


        return redirect()->route('data_siswa.data')->with('success', 'Berhasil Menambah Data Siswa!');
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
        $student = Student::find($id);
        return view('student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|max:100',
            'rombel' => 'required',
            'gender' => 'required',
            'rayon' => 'required',
        ]);

        $student= Student::find($id);

        $student->update([
            'name' => $request->name,
            'rombel' => $request->rombel,
            'gender' => $request->gender,
            'rayon' => $request->rayon
        ]);

        return redirect()->route('data_siswa.data')->with('success', 'Berhasil Mengubah Data');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        Student::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
