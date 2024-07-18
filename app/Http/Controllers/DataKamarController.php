<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Rooms;
use Illuminate\Http\Request;

class DataKamarController extends Controller
{
    public function index()
    {
        $rooms = Rooms::all();
        return Inertia::render('Kamar/index', ['rooms' => $rooms]);
    }

    public function create()
    {
        return Inertia::render('Kamar/create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'room_number' => 'required',
            'room_price' => 'required',
            'room_status' => 'required',
        ]);
        Rooms::create($data);
        return redirect()->route('kamar.index')->with('success', 'Data kamar berhasil disimpan');
    }


    

    public function edit(string $id)
    {
        $room = Rooms::findOrFail($id);
        return Inertia::render('Kamar/edit', ['room' => $room]);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'room_number' => 'required',
            'room_price' => 'required',
            'room_status' => 'required',
        ]);

        $room = Rooms::findOrFail($id);
        $room->update($data);

        return redirect()->route('kamar.index')->with('success', 'Data kamar berhasil diubah');
    }


    public function destroy(string $id)
    {
        $room = Rooms::findOrFail($id);
        $room->delete();

        return response()->json(['success' => 'Data kamar berhasil dihapus'], 200);
    }

}
