<?php

namespace App\Http\Controllers;

use App\Models\JurusanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JurusanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('jurusan.index');
    }

    public function jurusan()
    {
        return DataTables::of(JurusanModel::all())
        ->addColumn('Actions', function($data) {
            return '
            <a href="'.route('jurusan-edit', $data->id).'" class="btn btn-success btn-sm">Edit</a>
                <button type="button" data-id="'.$data->id.'" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
        })
        ->rawColumns(['Actions'])
        ->make(true);
    }

    public function create()
    {
        return view('jurusan.create');
    }

    public function store(Request $request)
    {
        $validation = $request->only(['name']);

        $jurusan = JurusanModel::create([
            'name' => $validation['name'],
        ]);

        return redirect()->route('jurusan');
    }

    public function edit($id)
    {
        $jurusan = JurusanModel::find($id);
        return view('jurusan.edit', ['jurusan' => $jurusan]);
    }

    public function update(Request $request, $id)
    {
        $validation = $request->only(['name']);
        $jurusan = JurusanModel::find($id);

        $jurusan->name = $validation['name'];
        $jurusan->save();

        return redirect()->route('jurusan');
    }

    public function delete($id)
    {
        $jurusan = JurusanModel::find($id);
        $jurusan->delete();

        return response()->json('delete success');
    }
}
