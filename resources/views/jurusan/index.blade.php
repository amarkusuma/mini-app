@extends('dashboard')

@section('content-view')
<div class="datatable-jurusan">
    <div class="d-flex justify-content-between">
        <h3 class="mb-5">Data Jurusan</h3>
        <div>
            <a href="{{route('jurusan-create')}}" class="btn btn-primary">Tambah Data</a>
        </div>
    </div>
    <table class="table table-bordered" id="jurusan-table">
        <thead>
           <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Action</th>
           </tr>
        </thead>
    </table>
</div>

<script>
    $(function() {
          $('#jurusan-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ url('jurusan-datatable') }}',
          columns: [
                   { data: 'id', name: 'id' },
                   { data: 'name', name: 'name' },
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
            url: "jurusan-delete/"+id,
            method: 'POST',
            success: function(result) {
                $('#jurusan-table').DataTable().ajax.reload();
            }
        });
    })
</script>

@endsection
