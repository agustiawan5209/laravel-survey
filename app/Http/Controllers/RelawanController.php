<?php

namespace App\Http\Controllers;

use App\Models\Relawan;
use App\Models\LokasiRelawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class RelawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $vali =  Request::validate([
            'nama'=> ['required', 'string', 'max:50'],
            'alamat'=> ['required', 'string', 'max:50'],
            'no_hp'=> ['required', 'numeric'],
            'kabupaten'=> ['required', 'string', 'max:50'],
            'kecamatan'=> ['required', 'string', 'max:50'],
            'kelurahan'=> ['required', 'string', 'max:50'],
            'desa'=> ['required', 'string', 'max:50'],
        ]);
        $lokasi = LokasiRelawan::where('kabupaten', Request::input('kabupaten'))
        ->where('kecamatan', Request::input('kecamatan'))
        ->where('kelurahan', Request::input('kelurahan'))
        ->where('desa', Request::input('desa'))
        ->first();
        if($lokasi == null){
            $lokasi = LokasiRelawan::create([
                'kabupaten'=> Request::input('kabupaten'),
                'kecamatan'=> Request::input('kecamatan'),
                'kelurahan'=> Request::input('kelurahan'),
                'desa'=> Request::input('desa'),
            ]);
        }

        Relawan::create([
            'nama'=> Request::input('nama'),
            'lokasi_id'=> $lokasi->id,
            'alamat'=> Request::input('alamat'),
            'no_hp'=> Request::input('no_hp'),
            'user_id'=> Auth::user()->id,
        ]);
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Relawan $relawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Relawan $relawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Relawan $relawan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Relawan $relawan)
    {
        //
    }
}
