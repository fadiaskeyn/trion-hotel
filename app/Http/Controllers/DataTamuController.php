<?php


namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Visitor;
use Illuminate\Http\Request;

class DataTamuController extends Controller
{
    public function index(){
        $visitors = Visitor::all();
        return Inertia::render('tamu/index', [
            'visitors' => $visitors
        ]);
    }
}
