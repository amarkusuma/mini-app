@extends('dashboard')

@section('content-view')
<div class="datatable-mahasiswa">
    <div class="d-flex justify-content-between">
        <h3 class="mb-5">Data Mahasiswa</h3>
        <div>
            <a href="{{route('mahasiswa-create')}}" class="btn btn-primary">Tambah Data</a>
        </div>
    </div>
    <table class="table table-bordered" id="mahasiswa-table">
        <thead>
           <tr>
              <th>Id</th>
              <th>Foto</th>
              <th>Name</th>
              <th>Status</th>
              <th>Fakultas</th>
              <th>Jurusan</th>
              <th>Action</th>
           </tr>
        </thead>
    </table>
</div>

<script>
    $(function() {
          $('#mahasiswa-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ url('mahasiswa-datatable') }}',
          columns: [
                   { data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }},
                   { data: 'image', name: 'image', sClass:'text-center' },
                   { data: 'name', name: 'name' },
                   { data: 'status_name', name: 'status_name' },
                   { data: 'fakultas_name', name: 'fakultas_name' },
                   { data: 'jurusan_name', name: 'jurusan_name' },
                   {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
                ]
       });
    });

    $('body').on('click', '#getDeleteId', function(){
        id = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "mahasiswa-delete/"+id,
            method: 'POST',
            success: function(result) {
                $('#mahasiswa-table').DataTable().ajax.reload();
            }
        });
    })
</script>

@endsection
