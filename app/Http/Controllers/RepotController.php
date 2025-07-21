<?php

namespace App\Http\Controllers;

use App\Exports\ExportExcel;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\History;
use App\Models\Repot;
use App\Models\Respon;
use Illuminate\Http\Request;
        use Illuminate\Support\Facades\Auth;

class RepotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Repot::with('user');

        if ($request->has('province') && $request->province != '') {
            $query->where('provinsi', 'LIKE', '%' . $request->province . '%');
        }
        $repots = $query->get();

        return view('pages.data_guest', compact('repots'));
    }

    public function indexStaff(Request $request)
    {
        //
        $query = Repot::with('user');

        if ($request->has('province') && $request->province != '') {
            $query->where('provinsi', 'LIKE', '%' . $request->province . '%');
        }
        $repots = $query->get();

        return view('pages.data_staff', compact('repots'));
    }

    public function prosesStaff($id)
    {
        $response = Respon::where('repot_id', $id)->get();
        if($response->isEmpty()){
            $response = Respon::create([
                'repot_id' => $id,
                'respon_status' => 'ON_PROSES',
            ]);

            return $response;
        }

        $repot = Repot::with(['respon', 'history'])->where('id', $id)->first();
 
        return view('staff.proses', compact('repot'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('guest.keluhan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'keluhan' => 'required',
            'type' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $direktori_penyimpanan = 'images/repots';
        $image = $request->image;

        $image->move(public_path($direktori_penyimpanan), $image->getClientOriginalName());
        $requestData = Repot::create([
            'keluhan' => $request->keluhan,
            'type' => $request->type,
            'provinsi' => ($request->provinsi),
            'kota' => ($request->kota),
            'kecamatan' => ($request->kecamatan),
            'desa' => ($request->desa),
            'image' => $direktori_penyimpanan . '/' . $image->getClientOriginalName(),
            'user_id' => auth()->id(),
        ]);

        if ($requestData) {
            return redirect()->route('guest.progres', ['userId' => auth()->id()])->with('success', 'Berhasil menambahkan keluhan');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan keluhan');
        }
    }
    // $requestData['image'] = $direktori_penyimpanan. '/'. $image->getClientOriginalName();
    // $requestData['user_id'] = auth()->id(); // Set the user_id to the authenticated user's ID
    // Repot::create($requestData);



    public function showUserComplaints($userId)
    {
        $repots = Repot::where('user_id', $userId)->get();
        return view('guest.progres', compact('repots'));
    }

    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Repot $repot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $repots = Repot::findOrFail($id);

        // Save the progress update to the history
        History::create([
            'respon_id' => $repots->respon->id,
            'history' => json_encode(['progress_text' => $request->input('progress_text')]),
        ]);

        return redirect()->route('staff.proses', ['id' => $id])->with('success', 'Progress updated successfully.');
    }

    public function done($id)
    {
        $repots = Repot::findOrFail($id);
        $repots->respon_status = 'DONE';
        $repots->save();
        return redirect()->route('staff.proses', ['id' => $id])->with('success', 'Keluhan berhasil diselesaikan');
    }

    public function storeHistory(Request $request, $id)
    {
        $repot = Repot::findOrFail($id);

        // Save the progress update to the history
        $history = History::create([
            'repot_id' => $repot->id,
            'history' => json_encode(['progress_text' => $request->input('progress_text')]),
        ]);

        return response()->json(['success' => 'Progress updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $repot = Repot::findOrFail($id);
        $repot->delete();

        return redirect()->route('guest.progres', ['userId' => auth()->id()])->with('success', 'Keluhan berhasil dihapus');
    }

    public function vote(Request $request, $id)
    {
        $repot = Repot::findOrFail($id);
        $repot->vote();

        return response()->json(['success' => true, 'votingCount' => count(json_decode($repot->voting, true))]);
    }

    public function export()
    {
        return Excel::download(new ExportExcel, 'repots.xlsx');
    }
}


