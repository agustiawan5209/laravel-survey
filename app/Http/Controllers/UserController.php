<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'can' => [
                'edit' => Auth::user()->can('Admin edit'),
            ],
            'data' => User::all(),
        ]);
    }
}
