@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                      <h4 class="card-title">
                        Daftar Kegiatan
                    </h4>
                    </div>
                    <div class="col text-end">
                        <a href="{{route('presence.create')}}" class="btn btn-primary">Tambah Data</a>
                    </div>
                </div>
                
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Kegiatan</th>
                            <th>Waktu Mulai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presences as $presence)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $presence->nama_kegiatan }}</td>
                                <td>{{ date('d-m-Y', strtotime($presence->tgl_kegiatan)) }}</td>  <!-- Format tanggal -->
                                <td>{{ date('H:i', strtotime($presence->tgl_kegiatan)) }}</td>    <!-- Format waktu -->
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody> 
                </table>
            </div>
        </div> 
    </div>
@endsection