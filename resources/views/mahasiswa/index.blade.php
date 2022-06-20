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
                   { data: 'id', name: 'id' },
                   { data: 'name', name: 'name' },
                   { data: 'status.name', name: 'status' },
                   { data: 'fakultas.name', name: 'fakultas' },
                   { data: 'jurusan.name', name: 'jurusan' },
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
