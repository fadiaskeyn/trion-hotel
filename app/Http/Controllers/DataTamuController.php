<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DataTamuController extends Controller
{

    public function index()
    {
        // return Inertia::render('Tamu/index');
        return view('tamu.index');
    }

    public function indexjson()
    {
        $visitors = Visitor::all();
         return response()->json($visitors);
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
            $visitor = Visitor::create($data);
            return response()->json(['success' => true, 'visitor' => $visitor], 201);
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

        return response()->json(['message' => 'Data tamu berhasil diubah']);
    }

}

