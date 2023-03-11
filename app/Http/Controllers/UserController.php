<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Survey;
use App\Models\DataSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->ReturnLokasi();
    }
    public function index()
    {
        // dd(Auth::user()->datasurvey);

        if (Auth::user()->can('Admin list')) {
            $modalVar = false;
        } else {
            if (Auth::user()->jabatan == "Relawan") {
                if (Auth::user()->datasurvey == null) {
                    $modalVar = true;
                } else {
                    $modalVar = false;
                }
            }else{
                if(Auth::user()->jabatan === 'Korcab' || Auth::user()->jabatan === 'Korkab'){
                    $modalVar = false;
                }
            }
        }

        return Inertia::render('Dashboard', [
            'can' => [
                'edit' => Auth::user()->can('Admin edit'),
            ],
            'data' => User::all(),
            'user' => Auth::user(),
            'modal' => $modalVar,
            'dataSurvey' => DataSurvey::all(),
            'survey' => Survey::all(),
        ]);
    }


    public function ReturnLokasi()
    {
        // Data SUrvey;
        $all_user = User::where('jabatan', '=', "Relawan")->get();
        foreach ($all_user as $key => $item) {
            $lokasi_user = $item->lokasi;
            $data = DataSurvey::where('kelurahan_desa', 'like',  '%' . $item->lokasi . '%')->latest()->first();
            $dataSurvey[$key] = $data == null ? 0 : $data->id;
            if ($data != null) {
                User::find($item->id)->update(['datasurvey_id' => $data->id]);
            }
        }
    }
}
