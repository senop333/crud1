<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  </head>
  <body>
<div class="container my-5" >

<div class="card mb-4">
    <div class="card-body">
    <h4 class="text-center">{{ config('app.name') }}</h4>
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
             

    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <card-header>
                <h4 class="card-header">Form Absen</h4>
                </card-header>
            <div class="card-body">
                <form action="">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>                    
                    <button type="submit" class="btn btn-primary">Absen</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md">
        <div class="card">
        <card-header>
            <h4 class="card-header">Daftar Absen</h4>
        </card-header>
        <div class="card-body">

        </div>
    </div>
</div>
</div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>