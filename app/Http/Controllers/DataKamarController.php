<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Rooms;
use Illuminate\Http\Request;

class DataKamarController extends Controller
{
    public function index()
    {
        return Inertia::render('Kamar/index');
    }

    public function indexjson()
    {
        $rooms = Rooms::all();
        return response()->json($rooms);
    }

    public function create()
    {
        return Inertia::render('Kamar/create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'room_number' => 'required',
            'room_price' => 'required|numeric',
            'room_status' => 'required',
        ]);

        $room = Rooms::create($data);

        return response()->json(['Success' => 'Data Kamar Berhasil Ditambahkan'], 200);
    }



    public function edit($id)
    {
        $room = Rooms::findOrFail($id);
        return Inertia::render('Kamar/edit', ['room' => $room]);
    }

    public function show($id)
{
    $room = Rooms::findOrFail($id);
    return response()->json($room);
}

public function update(Request $request, $id)
{
    $data = $request->validate([
        'room_number' => 'required',
        'room_price' => 'required',
        'room_status' => 'required',
    ]);

    $room = Rooms::findOrFail($id);
    $room->update($data);
    // return response()->json(['Success' => 'Room updated successfully'], 200);
}



    public function destroy($id)
{
    $room = Rooms::find($id);
    $room->delete();
    return response()->json(['message' => 'Room deleted successfully'], 200);

}

}
