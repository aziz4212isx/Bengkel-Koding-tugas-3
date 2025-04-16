<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use App\Models\User;
use App\Models\Obat;
use App\Models\DetailPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriksaController extends Controller
{
    /**
     * Display a listing of the resource (for pasien and dokter).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check if the user is a patient and show only their examinations
        if (auth()->check() && auth()->user()->role == 'pasien') {
            $periksas = Periksa::with(['dokter', 'detailPeriksas.obat'])
                              ->where('id_pasien', auth()->id()) // Only show exams for the logged-in patient
                              ->latest()
                              ->get();
        } 
        // If the user is a doctor, show only their assigned examinations
        elseif (auth()->check() && auth()->user()->role == 'dokter') {
            $periksas = Periksa::with(['pasien', 'detailPeriksas.obat'])
                              ->where('id_dokter', auth()->id()) // Only show exams for the logged-in doctor
                              ->latest()
                              ->get();
        } 
        // Admin or other roles can see all examinations
        else {
            $periksas = Periksa::with(['dokter', 'pasien', 'detailPeriksas.obat'])
                              ->latest()
                              ->get();
        }

        // Return the view with the periksas data
        return view('pasien.periksa.index', compact('periksas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // If the user is a patient, pass their ID and name, along with a list of doctors
        if (auth()->check() && auth()->user()->role == 'pasien') {
            $pasienId = auth()->id();
            $pasienName = auth()->user()->nama;
            $dokters = User::where('role', 'dokter')->latest()->get();
            return view('pasien.periksa.create', compact('dokters', 'pasienId', 'pasienName'));
        } 
        // If the user is not a patient (admin), show all patients and doctors
        else {
            $pasiens = User::where('role', 'pasien')->latest()->get();
            $dokters = User::where('role', 'dokter')->latest()->get();
            return view('pasien.periksa.create', compact('dokters', 'pasiens'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        // Validate the incoming request data
        $req->validate([
            'id_pasien' => ['required', 'integer'],
            'id_dokter' => ['required', 'integer'],
        ]);

        // Store the new examination (Periksa)
        Periksa::create($req->all());

        // Redirect to the examinations page with a success message
        return redirect('pasien/periksa')->with('success', 'Berhasil Meminta Pemeriksaan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Retrieve the examination by ID and load the related data
        $periksa = Periksa::with(['dokter', 'pasien', 'detailPeriksas.obat'])->findOrFail($id);

        // Check if the user is authorized to view this examination
        if (auth()->check()) {
            if (auth()->user()->role == 'pasien' && $periksa->id_pasien != auth()->id()) {
                return redirect('pasien/periksa')->with('error', 'Anda tidak memiliki akses ke pemeriksaan ini');
            }

            if (auth()->user()->role == 'dokter' && $periksa->id_dokter != auth()->id()) {
                return redirect('dokter/periksa')->with('error', 'Anda tidak memiliki akses ke pemeriksaan ini');
            }
        }

        // Return the examination details page
        return view('pasien.periksa.show', compact('periksa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Retrieve the examination to be edited
        $periksa = Periksa::findOrFail($id);
        $dokters = User::where('role', 'dokter')->latest()->get();
        $pasiens = User::where('role', 'pasien')->latest()->get();
        $obats = Obat::latest()->get();
    
        // Check if the user has access to edit this examination
        if (auth()->check()) {
            if (auth()->user()->role == 'pasien' && $periksa->id_pasien != auth()->id()) {
                return redirect('pasien/periksa')->with('error', 'Anda tidak memiliki akses ke pemeriksaan ini');
            }
    
            if (auth()->user()->role == 'dokter' && $periksa->id_dokter != auth()->id()) {
                return redirect('dokter/periksa')->with('error', 'Anda tidak memiliki akses ke pemeriksaan ini');
            }
        }
    
        // Return the edit form with the examination data
        return view('pasien.periksa.edit', compact('periksa', 'dokters', 'pasiens', 'obats'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        // Retrieve the examination to be updated
        $periksa = Periksa::findOrFail($id);

        // Validate the incoming request data
        $req->validate([
            'id_pasien' => ['required', 'integer'],
            'id_dokter' => ['required', 'integer'],
            'tgl_periksa' => ['nullable', 'date'],
            'catatan' => ['nullable', 'string'],
            'biaya_periksa' => ['nullable', 'integer'],
            'obat_ids' => ['nullable', 'array'],
            'obat_ids.*' => ['integer', 'exists:obat,id'],
        ]);

        // Update the examination data
        $periksa->update($req->only([
            'id_pasien',
            'id_dokter',
            'tgl_periksa',
            'catatan',
            'biaya_periksa'
        ]));

        // Update the medications (DetailPeriksa) if any are selected
        if ($req->has('obat_ids')) {
            // Delete the old records in DetailPeriksa
            DetailPeriksa::where('id_periksa', $periksa->id)->delete();

            // Create new records for the selected medications
            foreach ($req->obat_ids as $obatId) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obatId
                ]);
            }
        }

        // Redirect to the examinations page with a success message
        return redirect('pasien/periksa')->with('success', 'Pemeriksaan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Retrieve the examination to be deleted
        $periksa = Periksa::findOrFail($id);

        // Check if the user has access to delete this examination
        if (auth()->check()) {
            if (auth()->user()->role == 'pasien' && $periksa->id_pasien != auth()->id()) {
                return redirect('pasien/periksa')->with('error', 'Anda tidak memiliki akses ke pemeriksaan ini');
            }

            if (auth()->user()->role == 'dokter' && $periksa->id_dokter != auth()->id()) {
                return redirect('dokter/periksa')->with('error', 'Anda tidak memiliki akses ke pemeriksaan ini');
            }
        }

        // Delete the related detail_periksa records
        DetailPeriksa::where('id_periksa', $id)->delete();

        // Delete the examination record
        $periksa->delete();

        // Redirect to the examinations page with a success message
        return redirect('pasien/periksa')->with('success', 'Pemeriksaan berhasil dihapus');
    }
}
