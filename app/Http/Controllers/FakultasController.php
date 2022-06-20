<?php

namespace App\Http\Controllers;

use App\Models\FakultasModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FakultasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('fakultas.index');
    }

    public function fakultas()
    {
        return DataTables::of(FakultasModel::all())
        ->addColumn('Actions', function($data) {
            return '
                <a href="'.route('fakultas-edit', $data->id).'" class="btn btn-success btn-sm">Edit</a>
                <button type="button" data-id="'.$data->id.'" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
        })
        ->rawColumns(['Actions'])
        ->make(true);
    }

    public function create()
    {
        return view('fakultas.create');
    }

    public function store(Request $request)
    {
        $validation = $request->only(['name']);

        $fakultas = FakultasModel::create([
            'name' => $validation['name'],
        ]);

        return redirect()->route('fakultas');
    }

    public function edit($id)
    {
        $fakultas = FakultasModel::find($id);
        return view('fakultas.edit', ['fakultas' => $fakultas]);
    }

    public function update(Request $request, $id)
    {
        $validation = $request->only(['name']);
        $fakultas = FakultasModel::find($id);

        $fakultas->name = $validation['name'];
        $fakultas->save();

        return redirect()->route('fakultas');
    }

    public function delete($id)
    {
        $fakultas = FakultasModel::find($id);
        $fakultas->delete();

        return response()->json('delete success');
    }
}
