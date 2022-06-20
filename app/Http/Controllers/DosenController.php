<?php

namespace App\Http\Controllers;

use App\Models\DosenModel;
use App\Models\FakultasModel;
use App\Models\JurusanModel;
use App\Models\ProvinceModel;
use App\Models\StatusModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DosenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dosen.index');
    }

    public function dosen()
    {
        $dosen = DosenModel::all();

        collect($dosen)->map(function($data) {
            $status = $data->status ? $data->status->name : null;
            $data['status'] = $status;
            $fakultas = $data->fakultas ? $data->fakultas->name : null;
            $data['fakultas'] = $fakultas;
            $jurusan = $data->jurusan ? $data->jurusan->name : null;
            $data['jurusan'] = $jurusan;

            return $data;
        });

        return DataTables::of($dosen)
        ->addColumn('Actions', function($data) {
            return '
            <a href="'.route('dosen-edit', $data->id).'" class="btn btn-success btn-sm">Edit</a>
                <button type="button" data-id="'.$data->id.'" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
        })
        ->rawColumns(['Actions'])
        ->make(true);
    }

    public function create()
    {
        $status = StatusModel::get();
        $jurusan = JurusanModel::get();
        $fakultas = FakultasModel::get();
        $province = ProvinceModel::get();

        return view('dosen.create',[
          'status' => $status,
          'jurusan' => $jurusan,
          'fakultas' => $fakultas,
          'province' => $province,
        ]);

    }

    public function store(Request $request)
    {
        $validation = $request->only(['name', 'status_id', 'fakultas_id', 'jurusan_id', 'address', 'prov_id', 'city_id', 'dis_id', 'subdis_id', 'Rt' ]);

        $dosen = DosenModel::create([
            'name' => $validation['name'],
            'status_id' => $request->status_id,
            'fakultas_id' => $request->fakultas_id,
            'jurusan_id' => $request->jurusan_id,
            'address' => $request->address,
            'prov_id' => $request->prov_id,
            'city_id' => $request->city_id,
            'dis_id' => $request->dis_id,
            'subdis_id' => $request->subdis_id,
            'Rt' => $request->Rt,
        ]);

        return redirect()->route('dosen');
    }

    public function edit($id)
    {
        $dosen = DosenModel::find($id);
        $status = StatusModel::get();
        $jurusan = JurusanModel::get();
        $fakultas = FakultasModel::get();
        $province = ProvinceModel::get();

        return view('dosen.edit', [
            'dosen' => $dosen,
            'status' => $status,
            'jurusan' => $jurusan,
            'fakultas' => $fakultas,
            'province' => $province,
        ]);
    }

    public function update(Request $request, $id)
    {
        $dosen = DosenModel::find($id);

        $validation = $request->only(['name', 'status_id', 'fakultas_id', 'jurusan_id', 'address', 'prov_id', 'city_id', 'dis_id', 'subdis_id', 'Rt' ]);

        $dosen->name = $validation['name'];
        $dosen->status_id = $request->status_id;
        $dosen->fakultas_id = $request->fakultas_id;
        $dosen->jurusan_id = $request->jurusan_id;
        $dosen->address = $request->address;
        $dosen->prov_id = $request->prov_id;
        $dosen->city_id = $request->city_id;
        $dosen->dis_id = $request->dis_id;
        $dosen->subdis_id = $request->subdis_id;
        $dosen->Rt = $request->Rt;
        $dosen->save();

        return redirect()->route('dosen');
    }

    public function delete($id)
    {
        $dosen = DosenModel::find($id);
        $dosen->delete();

        return response()->json('delete success');
    }
}
