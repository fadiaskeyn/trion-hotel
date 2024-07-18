<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Cashout;
use Illuminate\Http\Request;

class CashoutController extends Controller
{

    public function index()
    {
        $cashouts = Cashout::with('user')->get();
        return Inertia::render('Cashout/index', ['cashouts' => $cashouts]);
    }

}
