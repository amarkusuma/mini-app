@extends('dashboard')

@section('content-view')
<div class="create-mahasiswa">
    <h3 class="mb-5">Create Mahasiswa</h3>
    <form method="POST" action="{{route('mahasiswa-store')}}">
        @csrf
        <div class="form-row">
            <div class="col-lg-6 col-md-6 mb-2">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-2">
                <div class="form-group">
                    <label for="status">Status<span>*</span> </label>
                    <select class="form-control status" name="status_id" id="status" required>
                        <option selected disabled>Pilih Status</option>
                        @foreach ($status as $key => $item)
                            <option id="{{$item->id}}" value="{{ $item->id }}" >{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-2">
                <div class="form-group">
                    <label for="fakultas">Fakultas<span>*</span> </label>
                    <select class="form-control fakultas" name="fakultas_id" id="fakultas" required>
                        <option selected disabled>Pilih fakultas</option>
                        @foreach ($fakultas as $key => $item)
                            <option id="{{$item->id}}" value="{{ $item->id }}" >{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-2">
                <div class="form-group">
                    <label for="jurusan">Jurusan<span>*</span> </label>
                    <select class="form-control jurusan" name="jurusan_id" id="jurusan" required>
                        <option selected disabled>Pilih jurusan</option>
                        @foreach ($jurusan as $key => $item)
                            <option id="{{$item->id}}" value="{{ $item->id }}" >{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-2">
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea type="text" class="form-control" name="address" id="address" placeholder="Address" required rows="3"> </textarea>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-2">
                <div class="form-group">
                    <label for="province">province<span>*</span> </label>
                    <select class="form-control province" name="prov_id" id="province" required>
                        <option selected disabled>Pilih Province</option>
                        @foreach ($province as $key => $item)
                            <option id="{{$item->prov_id}}" value="{{ $item->prov_id }}" >{{ $item->prov_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 mb-2">
                <div class="form-group">
                    <label for="city">City<span>*</span> </label>
                    <select class="form-control city" name="city_id" id="city" required>
                        <option selected disabled>Pilih City</option>
                        {{-- @foreach ($city as $key => $item)
                            <option id="{{$item->id}}" value="{{ $item->id }}" >{{ $item->name }}</option>
                        @endforeach --}}
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 mb-2">
                <div class="form-group">
                    <label for="district">District<span>*</span> </label>
                    <select class="form-control district" name="dis_id" id="district" required>
                        <option selected disabled>Pilih District</option>
                        {{-- @foreach ($city as $key => $item)
                            <option id="{{$item->id}}" value="{{ $item->id }}" >{{ $item->name }}</option>
                        @endforeach --}}
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 mb-2">
                <div class="form-group">
                    <label for="subdistrict">Subdistrict<span>*</span> </label>
                    <select class="form-control subdistrict" name="subdis_id" id="subdistrict" required>
                        <option selected disabled>Pilih Subdistrict</option>
                        {{-- @foreach ($city as $key => $item)
                            <option id="{{$item->id}}" value="{{ $item->id }}" >{{ $item->name }}</option>
                        @endforeach --}}
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 mb-2">
                <div class="form-group">
                    <label for="Rt">RT/RW</label>
                    <input type="text" class="form-control" name="Rt" id="Rt" placeholder="Rt" required>
                </div>
            </div>

        </div>
        <button type="submit" class="btn btn-primary mt-4">Submit</button>
      </form>
</div>

<script>
    const prov_id = "{{ old('prov_id', isset($mahasiswa) ? $mahasiswa->prov_id : '') }}";
    const city_id = "{{ old('city_id', isset($mahasiswa) ? $mahasiswa->city_id : '') }}";
    const district_id = "{{ old('dis_id', isset($mahasiswa) ? $mahasiswa->dis_id : '') }}";
    const subdistrict_id = "{{ old('subdis_id', isset($mahasiswa) ? $mahasiswa->subdis_id : '') }}";

    $('#province').on('change', function(){
        const prov_id = $('#province').val();
        console.log(prov_id);
        $.ajax({
            type: 'GET',
            url: `/cities/${prov_id}`,
            data: {
                'prov_id': prov_id
            },
            beforeSend: function () {
                $('#city').empty();
                $('#district').empty();
                $('#subdistrict').empty();
                $('#city').html('<option value="" disabled>Pilih kota/kabupaten</option>');
                // $('#district').html('<option value="" selected disabled>Pilih kecamatan</option>');
            },
            success: function (data) {
                // console.log(data);
                var cityId = city_id;
                var select = $('#city');
                for (var i = 0; i < data.length; i++) {
                    var selected =  (cityId == data[i].city_id) ? 'selected' : '';
                    select.append('<option ' + selected +' id=' + data[i].city_id + ' value=' + data[i].city_id  + '>' + data[i].city_name + '</option>');
                }
                select.change();
            }
        });
        // .then(function () {
        //     $.ajax({
        //         type: 'GET',
        //         url: `/districts/${city_id}`,
        //         data: {
        //             'city_id': city_id
        //         },
        //         beforeSend: function () {
        //             $('#district').empty();
        //             $('#district').html('<option value="" disabled>Pilih kecamatan</option>');
        //         },
        //         success: function (data) {
        //             // console.log(data);
        //             var districtId = district_id;
        //             var select = $('#district');
        //             for (var i = 0; i < data.length; i++) {
        //                 var selected =  (districtId == data[i].dis_id) ? 'selected' : '';
        //                 select.append('<option ' + selected + ' id=' + data[i].dis_id + ' value=' + data[i].dis_id + '>' + data[i].dis_name + '</option>');
        //             }
        //             select.change();
        //         }
        //     });
        // });
    });

    $('#city').on('change', function(){
        const city_id = $('#city').val();

        $.ajax({
            type: 'GET',
            url: `/districts/${city_id}`,
            data: {
                'city_id': city_id
            },
            beforeSend: function () {
                $('#district').empty();
                $('#district').html('<option value="" disabled>Pilih kecamatan</option>');
            },
            success: function (data) {
                // console.log(data);
                var districtId = district_id;
                var select = $('#district');
                for (var i = 0; i < data.length; i++) {
                    var selected =  (districtId == data[i].dis_id) ? 'selected' : '';
                    select.append('<option ' + selected + ' id=' + data[i].dis_id + ' value=' + data[i].dis_id + '>' + data[i].dis_name + '</option>');
                }
                select.change();
            }
        });
    });

    $('#district').on('change', function(){
        const dis_id = $('#district').val();

        $.ajax({
            type: 'GET',
            url: `/subdistricts/${dis_id}`,
            data: {
                'dis_id': dis_id
            },
            beforeSend: function () {
                $('#subdistrict').empty();
                $('#subdistrict').html('<option value="" disabled>Pilih kecamatan</option>');
            },
            success: function (data) {
                var districtId = dis_id;
                var select = $('#subdistrict');
                for (var i = 0; i < data.length; i++) {
                    var selected =  (districtId == data[i].subdis_id) ? 'selected' : '';
                    select.append('<option ' + selected + ' id=' + data[i].subdis_id + ' value=' + data[i].subdis_id + '>' + data[i].subdis_name + '</option>');
                }
                select.change();
            }
        });
    });

</script>
@endsection
