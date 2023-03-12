<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\DataSurvey;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\KelurahanDesa;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class DataSurveyController extends Controller
{
    public function index()
    {
        return Inertia::render('DataSurvey/Index', [
            'data' => DataSurvey::filter(Request::only('search', 'kabupaten', 'kecamatan', 'desa'))->paginate(50),
            'kabupaten' => Kabupaten::all(),
            'kecamatan' => Kecamatan::filter(Request::only('kabupaten'))->get(),
            'desa' => KelurahanDesa::filter(Request::only('kecamatan'))->get(),
            'filter' => [
                'kabupaten' => Request::input('kabupaten'),
                'kecamatan' => Request::input('kecamatan'),
                'kabupaten' => Request::input('kabupaten'),
            ]
        ]);
    }

    public function store()
    {
        $valid = Request::validate([
            'kabupaten' => 'required|string|max:50',
            'kecamatan' => 'required|string|max:50',
            'kelurahan_desa' => 'required|string|max:50',
            'jumlah_kk' => 'required|numeric',
            'estimasi' => 'required|numeric',
            'relawan' => 'required|numeric',
        ]);
        $res = $this->GetProvinsi(Request::input('kabupaten'), Request::input('kecamatan'), Request::input('kelurahan_desa'), Request::input('jumlah_kk'), Request::input('estimasi'), Request::input('relawan'));

        DataSurvey::create($res);
        Kabupaten::create(['nama'=> $res['kabupaten']]);
        Kecamatan::create(['kabupaten'=> $res['kabupaten'], 'nama'=> $res['kecamatan']]);
        KelurahanDesa::create(['kecamatan'=> $res['kecamatan'], 'nama'=> $res['kelurahan_desa']]);
        return redirect()->route('DataSurvey.index');
    }

    public function create()
    {
        return Inertia::render('DataSurvey/Form');
    }

    public function edit($id)
    {
        return Inertia::render('DataSurvey/Edit', [
            'data' => DataSurvey::find($id),
        ]);
    }
    public function update($id)
    {
        $valid = Request::validate([
            'kabupaten' => 'required|string|max:50',
            'kecamatan' => 'required|string|max:50',
            'kelurahan_desa' => 'required|string|max:50',
            'jumlah_kk' => 'required|numeric',
            'estimasi' => 'required|numeric',
            'relawan' => 'required|numeric',
        ]);
        DataSurvey::find($id)->update($valid);
        return redirect()->route('DataSurvey.index');
    }
    public function destroy($id)
    {
        DataSurvey::find($id)->delete();
    }

    public function GetProvinsi($id_kabupaten,$id_kecamatan,$id_kelurahan, $jumlah_kk,$estimasi,$relawan)
    {

        $api_provinsi = "https://dev.farizdotid.com/api/daerahindonesia/provinsi/73";
        // API nama kota Sulawesi Selatan
        $api_kabupaten = 'https://emsifa.github.io/api-wilayah-indonesia/api/regency/'.$id_kabupaten.'.json';

        // API nama Kelurahan Sulawesi Selatan
        $api_kecamatan = "https://emsifa.github.io/api-wilayah-indonesia/api/district/". $id_kecamatan .".json";
        $api_kelurahan = "https://emsifa.github.io/api-wilayah-indonesia/api/village/". $id_kelurahan .".json";

        $data_kabupaten = Http::get($api_kabupaten);
        $data_kecamatan = Http::get($api_kecamatan);
        $data_kelurahan = Http::get($api_kelurahan);
        $array = [
            'kabupaten'=> json_decode($data_kabupaten)->name,
            'kecamatan'=> json_decode($data_kecamatan)->name,
            'kelurahan_desa'=> json_decode($data_kelurahan)->name,
            'jumlah_kk'=> $jumlah_kk,
            'estimasi'=> $estimasi,
            'relawan'=> $relawan,
        ];
        return $array;
    }

    public function getKabupaten(){
        $api_kabupaten = "https://www.emsifa.com/api-wilayah-indonesia/api/regencies/73.json";
        $response = Http::get($api_kabupaten);
        return json_decode($response);
    }
    public function getKecamatan($id)
    {
        // API nama Kecamatan Sulawesi Selatan
        $api_kecamatan = "https://www.emsifa.com/api-wilayah-indonesia/api/districts/". $id .".json";
        $response = Http::get($api_kecamatan);
        return json_decode($response);
    }
    public function getKelurahan($id)
    {
        // API nama Kecamatan Sulawesi Selatan
        $api_kelurahan = "https://www.emsifa.com/api-wilayah-indonesia/api/villages/". $id .".json";
        $response = Http::get($api_kelurahan);
        return json_decode($response);
    }
}
