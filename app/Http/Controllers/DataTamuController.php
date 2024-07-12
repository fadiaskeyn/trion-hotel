<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Visitor;
use Illuminate\Http\Request;

class DataTamuController extends Controller
{
    public function index()
    {
        $visitors = Visitor::all();
        return Inertia::render('Tamu/index', ['visitors' => $visitors]);
    }


    public function create()
    {
        return Inertia::render('Tamu/create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'nik' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);
        Visitor::create($data);
        return redirect()->route('data-tamu.index')->with('success', 'Data tamu berhasil ditambahkan');
    }


    public function destroy(string $id)
    {
        $data = Visitor::findOrFail($id);
        $data->delete();
        return response()->json(['success' => 'Data tamu berhasil dihapus'], 200);
    }
    public function edit(string $id)
    {
        $visitor = Visitor::findOrFail($id);
        return Inertia::render('Tamu/edit', ['visitor' => $visitor]);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'nik' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $visitor = Visitor::findOrFail($id);
        $visitor->update($data);

        return redirect()->route('data-tamu.index')->with('success', 'Data tamu berhasil diubah');
    }


}

