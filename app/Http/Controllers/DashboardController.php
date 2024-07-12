<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Visitor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $visitors = Visitor::all();
        return Inertia::render('Dashboard', ['visitors' => $visitors]);
    }
}
