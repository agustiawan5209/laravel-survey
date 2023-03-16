<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use GuzzleHttp\Client;
use App\Models\Relawan;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\DataSurvey;
use App\Models\KelurahanDesa;
use App\Models\Survey;
use Vinkla\Hashids\HashidsManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class DataSurveyController extends Controller
{
    protected $hashids;
    public function __construct()
    {
        $this->hashids = new \Hashids\Hashids(env('MY_SECRET_SALT_KEY', 'MySecretSalt'));
    }

    public function index()
    {
        $user = Auth::user();
        // dd($user);
        $survey = DataSurvey::with(['survey'])
            ->filter(Request::only('search', 'kabupaten', 'kecamatan', 'desa'))
            ->paginate(10);
        $kelurahan = KelurahanDesa::filter(Request::only('kecamatan'))->get();
        // dd($kelurahan);
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
            'kecamatan' => Kecamatan::filter(Request::only('kabupaten'))->get(),
            'desa' => $kelurahan,
            'filter' => [
                'kabupaten' => Request::input('kabupaten'),
                'kecamatan' => Request::input('kecamatan'),
                'desa' => Request::input('desa'),
            ],
            'can' => [
                'adminEdit' => Auth::user()->can('Admin edit'),
                'adminView' => Auth::user()->can('Admin list'),
                'kecamatanView' => Auth::user()->can('KEC list'),
                'kabupatenView'=> Auth::user()->can('KAB list'),

            ]
        ]);
    }

    public function store()
    {
        $valid = Request::validate([
            'kabupaten' => 'required|string|max:50',
            'kecamatan' => 'required|string|max:50',
            'kelurahan_desa' => 'required|string|max:50|unique:data_surveys,kelurahan_desa',
            'jumlah_kk' => 'required|numeric',
            'estimasi' => 'required|numeric',
            'relawan' => 'required|numeric',
        ]);
        if (Auth::user()->jabatan == "Korcab" || Auth::user()->jabatan == "KorKab") {
            $data_surveys = DataSurvey::create($valid);
            $kab = Kabupaten::where('nama', 'like', "%" . $valid['kabupaten'] . "%")->first();
            if ($kab == null) {
                $kab =  Kabupaten::create(['nama' => $valid['kabupaten']]);
            }
            $kec = Kecamatan::where('kabupaten', 'like', "%" . $valid['kabupaten'] . "%")
                ->where('nama', 'like', "%" . $valid['kecamatan'] . "%")->first();
            if ($kec == null) {
                $kec = Kecamatan::create(['kabupaten' => $valid['kabupaten'], 'nama' => $valid['kecamatan']]);
            }

            $kel = KelurahanDesa::where('kecamatan', 'like', "%" . $valid['kecamatan'] . "%")
                ->where('nama', 'like', "%" . $valid['kecamatan'] . "%")->first();
            if ($kel == null) {
                $kel = KelurahanDesa::create(['kecamatan' => $valid['kecamatan'], 'nama' => $valid['kelurahan_desa']]);
            }
        } else {
            $res = $this->GetProvinsi(Request::input('kabupaten'), Request::input('kecamatan'), Request::input('kelurahan_desa'), Request::input('jumlah_kk'), Request::input('estimasi'), Request::input('relawan'));

            $data_surveys = DataSurvey::create($res);
            $kab = Kabupaten::where('nama', 'like', "%" . $res['kabupaten'] . "%")->first();
            if ($kab == null) {
                $kab = Kabupaten::create(['nama' => $res['kabupaten']]);
            }
            $kec = Kecamatan::where('kabupaten', 'like', "%" . $res['kabupaten'] . "%")
                ->where('nama', 'like', "%" . $res['kecamatan'] . "%")->first();
            if ($kec == null) {
                $kec = Kecamatan::create(['kabupaten' => $res['kabupaten'], 'nama' => $res['kecamatan']]);
            }

            $kel = KelurahanDesa::where('kecamatan', 'like', "%" . $res['kecamatan'] . "%")
                ->where('nama', 'like', "%" . $res['kecamatan'] . "%")->first();
            if ($kel == null) {
                $kel = KelurahanDesa::create(['kecamatan' => $res['kecamatan'], 'nama' => $res['kelurahan_desa']]);
            }
            $KEL = Role::where(['name' => 'KEL'])->first();
            if ($KEL == null) {
                $KEL = Role::create(['name' => 'KEL']);
            }
            $KEL->givePermissionTo('KEL list');
            $KEL->givePermissionTo('KEL create');
            $KEL->givePermissionTo('KEL edit');
            $KEL->givePermissionTo('KEL delete');
            for ($i = 0; $i < number_format(Request::input('relawan')); $i++) {
                $kel_user = User::create(array(
                    "name" => "-------",
                    "username" => "user" . fake()->unique()->randomNumber(),
                    "email" => "kelurahan" . fake()->unique()->randomNumber() . "@gmail.com",
                    "email_verified_at" => NULL,
                    "password" => bcrypt('12345678'),
                    "lokasi" => $kel->nama,
                    "jabatan" => "Relawan",
                    "datasurvey_id" => $data_surveys->id,
                    "remember_token" => NULL,
                    "created_at" => "2023-03-07 21:57:00",
                    "updated_at" => "2023-03-07 21:57:00",
                ));
                $kel_user->assignRole($KEL);
                Relawan::create([
                    'nama' => $kel_user->name,
                    'no_hp' => "000000000",
                    'alamat' => "----------",
                    'user_id' => $kel_user->id,
                ]);
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
                'kecamatanView' => Auth::user()->can('KEC list'),
                'kabupatenView'=> Auth::user()->can('KAB list'),
            ],
            'user_kecamatan' => User::with(['kabupaten', 'kecamatan', 'relawan', 'kelurahan'])->find(Auth::user()->id),
            'lokasi' => Auth::user()->kecamatan,
            'lokasiKabupaten'=> Auth::user()->kabupaten
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


        $dataSurvey = DataSurvey::find($id);
        $user = User::where('datasurvey_id', $id)->delete();
        $dataSurvey->delete();

        return redirect()->route('DataSurvey.success')->with('success', 'Berhasil Di Hapus');
    }


    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
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
        $user = User::where('datasurvey_id', $id)->get();
        // dd($user);

        return Inertia::render('DataSurvey/Show', [
            'survey' => $survey,
            'lokasi' => DataSurvey::find($id),
            'can' => [
                'create' => Auth::user()->can('KEL create'),
                'listkec' => Auth::user()->can('KEC list'),
                'admin' => Auth::user()->can('Admin list'),
            ],
        ]);
    }

    public function ShowDataRelawan($username)
    {
        // dd(Survey::where('lokasi_survey', $id)->get());
        $survey = Survey::with(['lokasiSurvey'])->where('username_user', '=', $username)->get();
        $user = User::where('username', '=', $username)->first();
        $dataSurvey = DataSurvey::where('id', $user->datasurvey_id)->first();
        // dd($dataSurvey);
        return Inertia::render('DataSurvey/ShowDataRelawan', [
            'user' => $user,
            'survey' => $survey,
            'lokasi' => $dataSurvey,
            'can' => [
                'create' => Auth::user()->can('KEL create'),
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
    public function success()
    {
        return Inertia::render('DataSurvey/Success');
    }
}
