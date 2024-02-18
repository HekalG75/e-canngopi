
<section class="col-lg-12 connectedSortable">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Absen ini untuk pegawai Canngopi yang bekerja dari luar lokasi CanNgopi, agar tetap bisa absensi walaupun tidak dilokasi<br>
              Apabila ada kesalahan seperti tidak bisa absen/ terdapat error silahkan hubungi admin CanNgopi.<br>
              <br>
              <strong>Catatan (Opsional)</strong> hanya untuk absen pulang. seperti contoh " Hari ini mengerjakan projek canngopi "
            </div>
</section>

<section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

          <section class="col-lg-6">
    <!-- Map card -->
    <div class="card">
        <div class="card-header">
            Notifikasi
        </div>
        <form method="post" action="pegawaioutside/proses_absen">
            <div class="card-body">
                <?php if ($waktu != 'dilarang') { ?>
                <p class="text-center">Hai, <?=$this->session->userdata('nama')?> anda hari ini belum melakukan absen <b><?=$waktu?></b>. Silahkan lakukan absen pada tombol absen berikut <br><br>
                    <button class="btn btn-success">Absen <?=$waktu?></button>
                </p>
                <input type="hidden" name="ket" id="ket" value="<?=$waktu?>">
                <input type="hidden" name="lok" id="lok" value="1">
                <!-- Kotak catatan opsional -->
                <div class="form-group">
                    <label for="catatan">Catatan (Opsional)</label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                </div>
                
                <?php } else { ?>
                <p class="text-center">Hai, <?=$this->session->userdata('nama')?> anda hari ini sudah melakukan absensi <b>Masuk</b>dan <b>Pulang</b></p>
                <?php }  ?>
            </div>
        </form>
    </div>
</section>
        </div>
      </div>
    </section>
    
          