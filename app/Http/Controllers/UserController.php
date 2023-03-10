<?php

namespace App\Http\Controllers;

use App\Models\DataSurvey;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // dd(Auth::user()->relawan);
        if (Auth::user()->relawan == null) {
            $modalVar = true;
        } else {
            $modalVar = false;
        }
        return Inertia::render('Dashboard', [
            'can' => [
                'edit' => Auth::user()->can('Admin edit'),
            ],
            'data' => User::all(),
            'user' => Auth::user(),
            'modal' => $modalVar,
            'dataSurvey' => DataSurvey::all(),
        ]);
    }
}
