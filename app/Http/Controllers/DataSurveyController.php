<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use GuzzleHttp\Client;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\DataSurvey;
use App\Models\KelurahanDesa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class DataSurveyController extends Controller
{
    public function index()
    {
        $user = Auth::user()->relawan;
        $survey = DataSurvey::with(['survey'])
            ->filter(Request::only('search', 'kabupaten', 'kecamatan', 'desa'))
            ->paginate(10);
        $kelurahan = KelurahanDesa::filter(Request::only('kecamatan'))->get();
        // Kondisi Cek Role Relawan
        if (Auth::user()->jabatan == "Relawan") {
            $survey = DataSurvey::with(['survey'])
                ->filter(Request::only('search', 'kabupaten', 'kecamatan', 'desa'))
                ->where('kelurahan_desa', Auth::user()->datasurvey->kelurahan_desa)
                ->paginate(10);
        } else if (Auth::user()->jabatan == "Korcab") {
            $survey = DataSurvey::with(['survey'])
                ->filter(Request::only('search', 'kabupaten', 'kecamatan', 'desa'))
                ->where('kecamatan', Auth::user()->lokasi)
                ->paginate(10);
            // Kelurahan
            $kelurahan = KelurahanDesa::where('kecamatan', 'like', '%' . Auth::user()->lokasi . '%')
                ->filter(Request::only('kecamatan'))->get();
        } else if (Auth::user()->jabatan == "Korkab") {
            $survey = DataSurvey::with(['survey'])
                ->filter(Request::only('search', 'kabupaten', 'kecamatan', 'desa'))
                ->where('kabupaten', Auth::user()->lokasi)
                ->paginate(10);
        }
        return Inertia::render('DataSurvey/Index', [
            'data' => $survey,
            'kabupaten' => Kabupaten::all(),
            'kecamatan' => KelurahanDesa::filter(Request::only('kabupaten'))->get(),
            'desa' => $kelurahan,
            'filter' => [
                'kabupaten' => Request::input('kabupaten'),
                'kecamatan' => Request::input('kecamatan'),
                'kabupaten' => Request::input('kabupaten'),
            ],
            'can' => [
                'adminEdit' => Auth::user()->can('Admin edit'),
                'adminView' => Auth::user()->can('Admin list'),
                'kecamatanView' => Auth::user()->can('KEC list')

            ]
        ]);
    }

    public function store()
    {
        $valid = Request::validate([
            'kabupaten' => 'required|string|max:50',
            'kecamatan' => 'required|string|max:50',
            'kelurahan_desa' => 'required|string|max:50|unique:data_surveys,kelurahan_desa',
            'jumlah_kk' => 'required|numeric|max:50',
            'estimasi' => 'required|numeric',
            'relawan' => 'required|numeric',
        ]);
        if (Auth::user()->jabatan == "Korcab") {
            DataSurvey::create($valid);
            $kab = Kabupaten::where('nama', 'like', "%" . $valid['kabupaten'] . "%")->get();
            if ($kab->count() < 1) {
                Kabupaten::create(['nama' => $valid['kabupaten']]);
            }
            $kec = Kecamatan::where('kabupaten', 'like', "%" . $valid['kabupaten'] . "%")
                ->where('nama', 'like', "%" . $valid['kecamatan'] . "%")->get();
            if ($kec->count() < 1) {
                Kecamatan::create(['kabupaten' => $valid['kabupaten'], 'nama' => $valid['kecamatan']]);
            }

            $kel = KelurahanDesa::where('kecamatan', 'like', "%" . $valid['kecamatan'] . "%")
                ->where('nama', 'like', "%" . $valid['kecamatan'] . "%")->get();
            if ($kel->count() < 1) {
                KelurahanDesa::create(['kecamatan' => $valid['kecamatan'], 'nama' => $valid['kelurahan_desa']]);
            }
        } else {
            $res = $this->GetProvinsi(Request::input('kabupaten'), Request::input('kecamatan'), Request::input('kelurahan_desa'), Request::input('jumlah_kk'), Request::input('estimasi'), Request::input('relawan'));

            DataSurvey::create($res);
            $kab = Kabupaten::where('nama', 'like', "%" . $res['kabupaten'] . "%")->get();
            if ($kab->count() < 1) {
                Kabupaten::create(['nama' => $res['kabupaten']]);
            }
            $kec = Kecamatan::where('kabupaten', 'like', "%" . $res['kabupaten'] . "%")
                ->where('nama', 'like', "%" . $res['kecamatan'] . "%")->get();
            if ($kec->count() < 1) {
                Kecamatan::create(['kabupaten' => $res['kabupaten'], 'nama' => $res['kecamatan']]);
            }

            $kel = KelurahanDesa::where('kecamatan', 'like', "%" . $res['kecamatan'] . "%")
                ->where('nama', 'like', "%" . $res['kecamatan'] . "%")->get();
            if ($kel->count() < 1) {
                KelurahanDesa::create(['kecamatan' => $res['kecamatan'], 'nama' => $res['kelurahan_desa']]);
            }
        }

        return redirect()->route('DataSurvey.index');
    }

    public function create()
    {
        // dd(Auth::user()->kecamatan);
        return Inertia::render('DataSurvey/Form', [
            'can' => [
                'adminEdit' => Auth::user()->can('Admin edit'),
                'adminView' => Auth::user()->can('Admin list'),
                'kecamatanView' => Auth::user()->can('KEC list')
            ],
            'user_kecamatan' => User::with(['kabupaten', 'kecamatan', 'relawan', 'kelurahan'])->find(Auth::user()->id),
            'lokasi'=> Auth::user()->kecamatan
        ]);
    }

    public function edit($id)
    {
        return Inertia::render('DataSurvey/Edit', [
            'data' => DataSurvey::find($id),
            'can' => [
                'adminEdit' => Auth::user()->can('Admin edit'),
            ]
        ]);
    }
    public function update($id)
    {
        $valid = Request::validate([
            'kabupaten' => 'required|string|max:50',
            'kecamatan' => 'required|string|max:50',
            'kelurahan_desa' => 'required|string|max:50|unique:data_surveys,kelurahan_desa',
            'jumlah_kk' => 'required|numeric',
            'estimasi' => 'required|numeric',
            'relawan' => 'required|numeric',
        ]);
        $res = $this->GetProvinsi(Request::input('kabupaten'), Request::input('kecamatan'), Request::input('kelurahan_desa'), Request::input('jumlah_kk'), Request::input('estimasi'), Request::input('relawan'));

        DataSurvey::find($id)->update($res);
        $kab = Kabupaten::where('nama', 'like', "%" . $res['kabupaten'] . "%")->first();
        if ($kab !== null) {
            Kabupaten::find($kab->id)->update(['nama' => $res['kabupaten']]);
        }
        $kec = Kecamatan::where('kabupaten', 'like', "%" . $res['kabupaten'] . "%")
            ->where('nama', 'like', "%" . $res['kecamatan'] . "%")->first();
        if ($kec !== null) {
            Kecamatan::find($kec->id)->update(['kabupaten' => $res['kabupaten'], 'nama' => $res['kecamatan']]);
        }

        $kel = KelurahanDesa::where('kecamatan', 'like', "%" . $res['kecamatan'] . "%")
            ->where('nama', 'like', "%" . $res['kecamatan'] . "%")->first();
        if ($kel !== null) {
            KelurahanDesa::find($kel->id)->update(['kecamatan' => $res['kecamatan'], 'nama' => $res['kelurahan_desa']]);
        }
        return redirect()->route('DataSurvey.index');
    }
    public function destroy($id)
    {
        DataSurvey::find($id)->delete();
    }
    public function show($id)
    {
        $survey = DataSurvey::with(['survey', 'user', 'user.relawan'])
            ->find($id);

        if (Auth::user()->jabatan == "Relawan") {
            $survey = DataSurvey::with(['survey', 'user', 'user.relawan'])
                ->where('kelurahan_desa', Auth::user()->datasurvey->kelurahan_desa)
                ->whereHas('survey', function ($q) {
                    $q->where('username_user', '=', Auth::user()->username);
                })
                ->find($id);
        } else if (Auth::user()->jabatan == "Korcab") {
            $survey = DataSurvey::with(['survey', 'user', 'user.relawan'])
                ->where('kecamatan', Auth::user()->lokasi)
                ->find($id);
        } else if (Auth::user()->jabatan == "Korkab") {
            $survey = DataSurvey::with(['survey', 'user', 'user.relawan'])
                ->where('kabupaten', Auth::user()->lokasi)
                ->find($id);
        }
        // dd($survey);

        return Inertia::render('DataSurvey/Show', [
            'survey' => $survey,
            'lokasi' => DataSurvey::find($id),
            'can' => [
                'create' => Auth::user()->can('DESA create'),
                'listkec' => Auth::user()->can('KEC list'),
                'admin' => Auth::user()->can('Admin list'),
            ],
        ]);
    }

    public function GetProvinsi($id_kabupaten, $id_kecamatan, $id_kelurahan, $jumlah_kk, $estimasi, $relawan)
    {

        $api_provinsi = "https://dev.farizdotid.com/api/daerahindonesia/provinsi/73";
        // API nama kota Sulawesi Selatan
        $api_kabupaten = 'https://emsifa.github.io/api-wilayah-indonesia/api/regency/' . $id_kabupaten . '.json';

        // API nama Kelurahan Sulawesi Selatan
        $api_kecamatan = "https://emsifa.github.io/api-wilayah-indonesia/api/district/" . $id_kecamatan . ".json";
        $api_kelurahan = "https://emsifa.github.io/api-wilayah-indonesia/api/village/" . $id_kelurahan . ".json";

        $data_kabupaten = Http::get($api_kabupaten);
        $data_kecamatan = Http::get($api_kecamatan);
        $data_kelurahan = Http::get($api_kelurahan);
        $array = [
            'kabupaten' => json_decode($data_kabupaten)->name,
            'kecamatan' => json_decode($data_kecamatan)->name,
            'kelurahan_desa' => json_decode($data_kelurahan)->name,
            'jumlah_kk' => $jumlah_kk,
            'estimasi' => $estimasi,
            'relawan' => $relawan,
        ];
        return $array;
    }

    public function getKabupaten()
    {
        $api_kabupaten = "https://www.emsifa.com/api-wilayah-indonesia/api/regencies/73.json";
        $response = Http::get($api_kabupaten);
        return json_decode($response);
    }
    public function getKecamatan($id)
    {
        // API nama Kecamatan Sulawesi Selatan
        $api_kecamatan = "https://www.emsifa.com/api-wilayah-indonesia/api/districts/" . $id . ".json";
        $response = Http::get($api_kecamatan);
        return json_decode($response);
    }
    public function getKelurahan($id)
    {
        // API nama Kecamatan Sulawesi Selatan
        $api_kelurahan = "https://www.emsifa.com/api-wilayah-indonesia/api/villages/" . $id . ".json";
        $response = Http::get($api_kelurahan);
        return json_decode($response);
    }
}
