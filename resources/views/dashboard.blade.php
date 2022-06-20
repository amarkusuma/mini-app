@extends('layouts.app')

{{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> --}}
<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-2">
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>APP MENU</h3>
                </div>

                <ul class="list-unstyled components list-menu">
                    @role('superadmin')
                    <li class="active">
                        <a href="{{route('fakultas')}}">Fakultas</a>
                    </li>
                    @endrole
                    @role('superadmin')
                    <li>
                        <a href="{{route('jurusan')}}">Jurusan</a>
                    </li>
                    @endrole
                    @role('superadmin|mahasiswa')
                    <li>
                        <a href="{{route('mahasiswa')}}">Mahasiswa</a>
                    </li>
                    @endrole
                    @role('superadmin|dosen')
                    <li>
                        <a href="{{route('dosen')}}">Dosen</a>
                    </li>
                    @endrole
                    {{-- <li>
                        <a href="#">Role</a>
                    </li> --}}
                </ul>
            </nav>
        </div>
        <div class="col-lg-10">
            <main class="py-4">
                @yield('content-view')
            </main>
        </div>
    </div>
</div>
@endsection

<style>
    .sidebar-header h3 {
        font-size: 22px;
        font-weight: 600;
        padding-left: 10px;
    }
    #sidebar {
        /* border: solid 1px; */
        padding: 10px;
    }
    #sidebar .list-menu li {
        /* border-bottom: 0.5px solid gray; */
        padding: 10px;
    }
    #sidebar .list-menu li a {
        text-decoration: none;
        font-size: 1.2em;
        font-weight: 500;
    }
    #sidebar .list-menu li:hover,
    .list-menu li:hover a  {
        background-color: black;
        color: #FFFFFF;
    }
</style>
