<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Inertia\Inertia;
use App\Models\DataSurvey;
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
        $survey = DataSurvey::with(['survey'])
            ->filter(Request::only('search'))
            ->paginate(10);

        if (Auth::user()->jabatan == "Relawan") {
            $survey = DataSurvey::with(['survey'])
                ->filter(Request::only('search'))
                ->where('kelurahan_desa', Auth::user()->datasurvey->kelurahan_desa)
                ->paginate(10);
        } else if (Auth::user()->jabatan == "Korcab") {
            $survey = DataSurvey::with(['survey'])
                ->filter(Request::only('search'))
                ->where('kecamatan', Auth::user()->lokasi)
                ->paginate(10);
        } else if (Auth::user()->jabatan == "Korkab") {
            $survey = DataSurvey::with(['survey'])
                ->filter(Request::only('search'))
                ->where('kabupaten', Auth::user()->lokasi)
                ->paginate(10);
        }
        return Inertia::render('Survey/Index', [
            'survey' => $survey,
            'can' => [
                'create' => Auth::user()->can('DESA create'),
                'listkec' => Auth::user()->can('KEC list'),
                'admin' => Auth::user()->can('Admin list'),

            ],
            'search' => Request::only('search'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Survey/Form', [
            'lokasi' => Auth::user()->datasurvey
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
        $kabupaten = Auth::user()->datasurvey->kabupaten;
        $kecamatan = Auth::user()->datasurvey->kecamatan;
        $kelurahan = Auth::user()->datasurvey->kelurahan_desa;
        $desa = Auth::user()->datasurvey->kelurahan_desa;
        $survey = DataSurvey::where('kabupaten', $kabupaten)
            ->where('kecamatan', $kecamatan)
            ->where('kelurahan_desa', $kelurahan)
            ->first();
        // if ($survey == null) {
        //     $survey = DataSurvey::create([
        //         'kabupaten' => $kabupaten,
        //         'kecamatan' => $kecamatan,
        //         'kelurahan' => $kelurahan,

        //     ]);
        // }
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
            'username_user' => Auth::user()->username,
        ]);

        return redirect()->route('Survey.success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // dd(Survey::where('lokasi_survey', $id)->get());
        $survey = DataSurvey::with(['survey'])
            ->find($id);

        if (Auth::user()->jabatan == "Relawan") {
            $survey = DataSurvey::with(['survey'])
                ->where('kelurahan_desa', Auth::user()->datasurvey->kelurahan_desa)
                ->whereHas('survey', function($q){
                    $q->where('username_user', '=', Auth::user()->username);
                })
                ->find($id);
        } else if (Auth::user()->jabatan == "Korcab") {
            $survey = DataSurvey::with(['survey'])
                ->where('kecamatan', Auth::user()->lokasi)
                ->find($id);
        } else if (Auth::user()->jabatan == "Korkab") {
            $survey = DataSurvey::with(['survey'])
                ->where('kabupaten', Auth::user()->lokasi)
                ->find($id);
        }
        return Inertia::render('Survey/Show', [
            'survey' => $survey,
            'lokasi' => DataSurvey::find($id),
            'can' => [
                'create' => Auth::user()->can('DESA create'),
                'listkec' => Auth::user()->can('KEC list'),
                'admin' => Auth::user()->can('Admin list'),

            ],
        ]);
    }
    public function detail($id){
        return Inertia::render('Survey/Detail', [
            'data'=> Survey::with(['lokasisurvey'])->find($id),
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
