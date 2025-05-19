@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                      <h4 class="card-title">
                        Detail Absen
                    </h4>
                    </div>
                    <div class="col text-end">
                        <button type="button" onclick="copyLink()" class="btn btn-warning">Copy Link</button>
                        <a href="{{route('presence.index')}}" class="btn btn-danger">Export to PDF</a>
                        <a href="{{route('presence.index')}}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
                
            </div>
            <div class="card-body">
                <table class="table table-boderless">
                    <tr>
                        <td width="150">Nama Kegiatan</td>
                        <td width="20">:</td>
                        <td>{{ $presence->nama_kegiatan }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Kegiatan</td>
                        <td>:</td>
                        <td>{{ date('d F Y', strtotime($presence->tgl_kegiatan)) }}</td>  <!-- Format tanggal -->
                    </tr>
                    <tr>
                        <td>Waktu Mulai</td>
                        <td>:</td>
                        <td>{{ date('H:i', strtotime($presence->tgl_kegiatan)) }}</td>    <!-- Format waktu -->
                    </tr>
                </table>
             <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Asal Instansi</th>
                        <th>Tanda Tangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                     @if ($presenceDetails->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data</td>
                            </tr>
                     @endif
                    @foreach ($presenceDetails as $detail)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $detail->nama }}</td>
                            <td>{{ $detail->jabatan }}</td>
                            <td>{{ $detail->asal_instansi }}</td>
                            <td>{{ $detail->tanda_tangan }}</td>



                            <td>
                                <form action="{{ route('presence-detail.destroy', $presence->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody> 
            </table> 
            </div>
        </div> 
    </div>
@endsection

@push('js')
    <script>
       function copyLink() {
            // Get the current URL
            navigator.clipboard.writeText("{{route('absen.index', $presence->slug)}}");

            // Show an alert or notification to indicate that the link has been copied
            alert("Link telah disalin ke clipboard: " + "{{route('absen.index', $presence->slug)}}");
        }
     
    </script>
    
@endpush