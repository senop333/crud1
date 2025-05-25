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
    <div class="card-header">
        <h4 class="text-center">{{ config('app.name') }}</h4>
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
             

    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <card-header>
                <h4 class="card-header">Form Absen</h4>
                </card-header>
            <div class="card-body">
                <form id="form-absen" action=" {{ route('absen.save', $presence->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>                       
                        @enderror                     
                    </div>   
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan">
                        @error('jabatan')
                            <div class="text-danger">{{ $message }}</div>                       
                        @enderror                     
                    </div>
                    <div class="mb-3">
                        <label for="asal_instansi" class="form-label">Asal Instansi</label>
                        <input type="text" class="form-control" id="asal_instansi" name="asal_instansi">
                        @error('asal_instansi')
                            <div class="text-danger">{{ $message }}</div>                       
                        @enderror                     
                    </div>
                    <div class="mb-3">
                        <label for="tanda_tangan" class="form-label">Tanda Tangan</label>
                        <div class="db-block form-control mb-2">
                            <canvas id="signature-pad" class="signature-pad">
                            </canvas>
                            <textarea name="signature" id="signature64" class="d-none"></textarea>
                        </div>
                        @error('signature')
                            <div class="text-danger">{{ $message }}</div> 
                        @enderror
                        <button class="button" id="clear" class="btn btn-sm btn-secondary">Clear</button>
                    </div>           
                    <button type="submit" class="btn btm-sm btn-primary">Absen</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md">
        <div class="card">
        <card-header>
            <h4 class="card-header">Daftar Kehadiran</h4>
        </card-header>
        <div class="card-body">
                         <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Asal Instansi</th>
                        <th>Tanda Tangan</th>
                    </tr>
                </thead>
                                 @if ($presenceDetails->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                     @endif
                    @foreach ($presenceDetails as $detail)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $detail->nama }}</td>
                            <td>{{ $detail->jabatan }}</td>
                            <td>{{ $detail->asal_instansi }}</td>
                            <td>
                                    @if ($detail->tanda_tangan)
                                        

                                    <img src="{{ asset('storage/' . $detail->tanda_tangan) }}" alt="tanda_tangan" style="width: 100px; height: auto;">

                                   
                                   
                                   
                                        @else
                                        Tidak ada tanda tangan
                                    @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
</div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{asset('js/signature.min.js')}}"></script>
        <script>
        $(function () {
            const $canvas = $('#signature-pad');
            const $textarea = $('#signature64');

            // Sesuaikan lebar canvas dengan parent-nya
            let canvasWidth = $canvas.parent().width();
            $canvas.attr('width', canvasWidth);
            $canvas.attr('height', 200); // beri tinggi agar bisa ditulis

            // Inisialisasi SignaturePad
            const signaturePad = new SignaturePad($canvas[0], {
            backgroundColor: 'rgba(255,255,255,0)',
            penColor: 'rgb(0, 0, 0)',
            });

            // Saat mouse/touch selesai menulis, simpan ke textarea
            $canvas.on('mouseup touchend', function () {
            if (!signaturePad.isEmpty()) {
                const dataURL = signaturePad.toDataURL();
                $textarea.val(dataURL);
            }
            });

            // Backup: Simpan saat form disubmit
            $('form').on('submit', function () {
            if (!signaturePad.isEmpty()) {
                const dataURL = signaturePad.toDataURL();
                $textarea.val(dataURL);
            }
            });

            // Tombol clear
            $('#clear').on('click', function (e) {
                e.preventDefault();
                signaturePad.clear();
                $textarea.val(''); // Kosongkan textarea
            });

            $('form-absen').on('submit', function (e) {
                e.preventDefault(); // Mencegah submit default
                if (signaturePad.isEmpty()) {
                    alert('Silakan tanda tangani sebelum mengirim.');
                    return;
                }
                // Jika sudah ada tanda tangan, kirim form
                this.submit();
            });
        });
        </script>
</body>
</html>