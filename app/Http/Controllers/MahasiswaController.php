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
        $mahasiswa = MahasiswaModel::query();

        // collect($mahasiswa)->map(function($data) {
        //     $status = $data->status ? $data->status->name : null;
        //     $data['status'] = $status;
        //     $fakultas = $data->fakultas ? $data->fakultas->name : null;
        //     $data['fakultas'] = $fakultas;
        //     $jurusan = $data->jurusan ? $data->jurusan->name : null;
        //     $data['jurusan'] = $jurusan;

        //     return $data;
        // });

        return DataTables::of($mahasiswa)
        ->addColumn('Actions', function($data) {
            return '
            <a href="'.route('mahasiswa-edit', $data->id).'" class="btn btn-success btn-sm">Edit</a>
                <button type="button" data-id="'.$data->id.'" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
        })
        ->addColumn('image', function($data){
            return '<img src="/storage/asset/mahasiswa/'.$data->foto.'" style="width:50px;height:50px">';
        })
        ->addColumn('fakultas_name', function($data){
            $fakultas = $data->fakultas ? $data->fakultas->name : null;
            return $fakultas;
        })
        ->addColumn('jurusan_name', function($data){
            $jurusan = $data->jurusan ? $data->jurusan->name : null;
            return $jurusan;
        })
        ->addColumn('status_name', function($data){
            $status = $data->status ? $data->status->name : null;
            return $status;
        })
        ->orderColumn('id', '-id $1')
        ->rawColumns(['Actions', 'fakultas_name', 'jurusan_name', 'status_name', 'image'])
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

        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2000',
        ]);

        if($request->hasFile('foto')){
            $image  = $request->file('foto');
            $imageName = time().'.'.$image->extension();
            $image->storeAs('public/asset/mahasiswa/', $imageName);
        }

        $mahasiswa = MahasiswaModel::create([
            'name' => $validation['name'],
            'foto' => $imageName ?? null,
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

        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2000',
        ]);

        $mahasiswa = MahasiswaModel::find($id);

        if ($request->hasFile('foto')) {
            $image  = $request->file('foto');
            $imageName = time().'.'.$image->extension();
            $image->storeAs('public/asset/mahasiswa/', $imageName);
            $file = public_path('/storage/asset/mahasiswa/'.$mahasiswa->foto);
            if (file_exists($file) && !empty($mahasiswa->foto)) {
                unlink($file);
            }
        }

        $mahasiswa->name = $validation['name'];
        $mahasiswa->foto = $imageName ?? $mahasiswa->foto;
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
        if (!empty($mahasiswa->foto)) {
            $file = public_path('/storage/asset/mahasiswa/'.$mahasiswa->foto);
            if (file_exists($file) && !empty($mahasiswa->foto)) {
                unlink($file);
            }
        }

        $mahasiswa->delete();

        return response()->json('delete success');
    }
}
