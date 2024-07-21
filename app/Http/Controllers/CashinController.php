<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Payment;
use Illuminate\Http\Request;

class CashinController extends Controller
{

        public function index(){
            $payments = Payment::with('order.visitor')->get();
            return Inertia::render('Cashin/index', ['payments' => $payments]);
        }
    }


