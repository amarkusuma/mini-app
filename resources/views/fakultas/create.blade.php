@extends('dashboard')

@section('content-view')
<div class="create-fakultas">
    <h3 class="mb-5">Create Fakultas</h3>
    <form method="POST" action="{{route('fakultas-store')}}">
        @csrf
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
          </div>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Submit</button>
      </form>
</div>
@endsection
