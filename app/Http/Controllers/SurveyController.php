<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Inertia\Inertia;
use App\Models\LokasiSurvey;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->relawan;
        return Inertia::render('Survey/Index', [
            'survey' => LokasiSurvey::with(['survey'])
            ->filter(Request::only('search'))
            ->paginate(10),
            'can' => [
                'create' => Auth::user()->can('DESA create'),
            ],
            'search'=> Request::only('search'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Survey/Form', [
            'lokasi' => Auth::user()->relawan->lokasi
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        Request::validate([
            'rt_rw' => 'required|string|max:50',
            'tps' => 'required|numeric|max:50',
            'nama' => 'required|string|max:50',
            'kepala_keluarga' => 'required|string|max:50',
            'alamat' => 'required|string|max:200',
            'no_hp' => 'required|string|max:25',
            'jumlah_memilih' => 'required|numeric|max:10',
            'pertanyaan1' => 'string|nullable|max:50',
            'textpertanyaan1' => 'string|nullable|max:100',
            'pertanyaan2' => 'required|max:50',
        ]);
        if (Request::input('pertanyaan1') == null && Request::input('textpertanyaan1') == null) {
            Request::validate([
                'pertanyaan1' => 'required',
            ]);
        }
        $kabupaten = Auth::user()->relawan->lokasi->kabupaten;
        $kecamatan = Auth::user()->relawan->lokasi->kecamatan;
        $kelurahan = Auth::user()->relawan->lokasi->kelurahan;
        $desa = Auth::user()->relawan->lokasi->desa;
        $survey = LokasiSurvey::where('kabupaten', $kabupaten)
            ->where('kecamatan', $kecamatan)
            ->where('kelurahan', $kelurahan)
            ->first();
        if ($survey == null) {
            $survey = LokasiSurvey::create([
                'kabupaten' => $kabupaten,
                'kecamatan' => $kecamatan,
                'kelurahan' => $kelurahan,

            ]);
        }
        Survey::create([
            'desa' => $desa,
            'lokasi_survey' => $survey->id,
            'rt_rw' => Request::input('rt_rw'),
            'tps' => Request::input('tps'),
            'nama' => Request::input('nama'),
            'kepala_keluarga' => Request::input('kepala_keluarga'),
            'alamat' => Request::input('alamat'),
            'no_hp' => Request::input('no_hp'),
            'jumlah_memilih' => Request::input('jumlah_memilih'),
            'pertanyaan1' => Request::input('pertanyaan1') == null ? Request::input('textpertanyaan1') : Request::input('pertanyaan1'),
            'pertanyaan2' => Request::input('pertanyaan2'),
        ]);

        return redirect()->route('Survey.success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // dd(Survey::where('lokasi_survey', $id)->get());
        return Inertia::render('Survey/Show', [
            'survey'=> Survey::where('lokasi_survey', $id)->get(),
            'lokasi'=> LokasiSurvey::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }


    /**
     * success
     *
     * @return void
     */
    public function success()
    {
        return Inertia::render('Survey/Success');
    }
}
