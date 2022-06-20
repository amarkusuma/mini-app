<?php

namespace App\Http\Controllers;

use App\Models\FakultasModel;
use App\Models\JurusanModel;
use App\Models\MahasiswaModel;
use App\Models\ProvinceModel;
use App\Models\StatusModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('mahasiswa.index');
    }

    public function mahasiswa()
    {
        $mahasiswa = MahasiswaModel::all();

        collect($mahasiswa)->map(function($data) {
            $status = $data->status ? $data->status->name : null;
            $data['status'] = $status;
            $fakultas = $data->fakultas ? $data->fakultas->name : null;
            $data['fakultas'] = $fakultas;
            $jurusan = $data->jurusan ? $data->jurusan->name : null;
            $data['jurusan'] = $jurusan;

            return $data;
        });

        return DataTables::of($mahasiswa)
        ->addColumn('Actions', function($data) {
            return '
            <a href="'.route('mahasiswa-edit', $data->id).'" class="btn btn-success btn-sm">Edit</a>
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

        return view('mahasiswa.create',[
          'status' => $status,
          'jurusan' => $jurusan,
          'fakultas' => $fakultas,
          'province' => $province,
        ]);
    }

    public function store(Request $request)
    {
        $validation = $request->only(['name', 'status_id', 'fakultas_id', 'jurusan_id', 'address', 'prov_id', 'city_id', 'dis_id', 'subdis_id', 'Rt' ]);

        $mahasiswa = MahasiswaModel::create([
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

        return redirect()->route('mahasiswa');
    }

    public function edit($id)
    {
        $status = StatusModel::get();
        $jurusan = JurusanModel::get();
        $fakultas = FakultasModel::get();
        $province = ProvinceModel::get();

        $mahasiswa = MahasiswaModel::find($id);
        return view('mahasiswa.edit', [
            'mahasiswa' => $mahasiswa,
            'status' => $status,
            'jurusan' => $jurusan,
            'fakultas' => $fakultas,
            'province' => $province,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validation = $request->only(['name', 'status_id', 'fakultas_id', 'jurusan_id', 'address', 'prov_id', 'city_id', 'dis_id', 'subdis_id', 'Rt' ]);
        $mahasiswa = MahasiswaModel::find($id);

        $mahasiswa->name = $validation['name'];
        $mahasiswa->status_id = $request->status_id;
        $mahasiswa->fakultas_id = $request->fakultas_id;
        $mahasiswa->jurusan_id = $request->jurusan_id;
        $mahasiswa->address = $request->address;
        $mahasiswa->prov_id = $request->prov_id;
        $mahasiswa->city_id = $request->city_id;
        $mahasiswa->dis_id = $request->dis_id;
        $mahasiswa->subdis_id = $request->subdis_id;
        $mahasiswa->Rt = $request->Rt;
        $mahasiswa->save();

        return redirect()->route('mahasiswa');
    }

    public function delete($id)
    {
        $mahasiswa = MahasiswaModel::find($id);
        $mahasiswa->delete();

        return response()->json('delete success');
    }
}
