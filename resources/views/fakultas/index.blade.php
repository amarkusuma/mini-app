@extends('dashboard')

@section('content-view')

<div class="datatable-fakultas">
    <div class="d-flex justify-content-between">
        <h3 class="mb-5">Data Fakultas</h3>
        <div>
            <a href="{{route('fakultas-create')}}" class="btn btn-primary">Tambah Data</a>
        </div>
    </div>
    <table class="table table-bordered" id="fakultas-table">
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
          $('#fakultas-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ url('fakultas-datatable') }}',
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
            url: "fakultas-delete/"+id,
            method: 'POST',
            success: function(result) {
                $('#fakultas-table').DataTable().ajax.reload();
            }
        });
    })
</script>

@endsection
