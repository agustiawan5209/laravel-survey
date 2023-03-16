<?php

namespace App\Http\Controllers;

use Exception;
use Inertia\Inertia;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\DataSurvey;
use App\Models\KelurahanDesa;
use App\Exports\DataSurveyExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Request;


class CetakLaporanController extends Controller
{
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
        return Inertia::render('Cetak/Index', [
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

    public function cetakDataSurvey(){
        $file_name = '';
        $path =  'FileCETAK/';
        $namaPDF = $path . 'excelExport.xlsx';
        $filePATH = public_path() . '/' . $namaPDF;

        try {
            // to download directly need to return file
            return Excel::download((new DataSurveyExport(Request::input('kabupaten'))), 'excelExport.xlsx', null, [\Maatwebsite\Excel\Excel::XLSX]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function cetakDataSurveyPDF(){
        $file_name = '';
        $path =  'FileCETAK/';
        $namaPDF = $path . 'excelExport.pdf';
        $filePATH = public_path() . '/' . $namaPDF;

        try {
            // to download directly need to return file
            return Excel::download((new DataSurveyExport(Request::only('lokasi', 'dataSurvey_id'))), 'excelExport.pdf', null, [\Maatwebsite\Excel\Excel::DOMPDF]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
