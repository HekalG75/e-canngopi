
<section class="col-lg-12 connectedSortable">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Absen ini untuk pegawai Canngopi yang bekerja dari luar lokasi CanNgopi, agar tetap bisa absensi walaupun tidak dilokasi<br>
              Apabila ada kesalahan seperti tidak bisa absen/ terdapat error silahkan hubungi admin CanNgopi.<br>
            </div>
</section>

<section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

          <section class="col-lg-6 ">
            <!-- Map card -->
            <div class="card"> 
              <div class="card-header"> Notifikasi </h3>
              </div>
              <form method="post" action="pegawaioutsite/proses_absen">
               <div class="card-body">
                  <?php if ($waktu != 'dilarang') {
                  // Tentukan waktu absen yang diizinkan
                  $waktuAbsenMulai = strtotime('03:57:00'); // Ganti dengan waktu mulai yang diizinkan
                  $waktuAbsenSelesai = strtotime('03:58:00'); // Ganti dengan waktu selesai yang diizinkan
                  $waktuServerSekarang = strtotime(date('H:i:s'));

                  if ($waktuServerSekarang >= $waktuAbsenMulai && $waktuServerSekarang <= $waktuAbsenSelesai) {
                      ?>
                      <p class="text-center">Hai, <?=$this->session->userdata('nama')?>, Anda belum absen pada <b><?=$waktu?></b>. Silakan absen sekarang!<br><br>
                          <button class="btn btn-primary">Absen <?=$waktu?></button></p>
                      <input type="hidden" name="ket" id="ket" value="<?=$waktu?>">
                      <input type="hidden" name="lok" id="lok" value="1">
                      <?php
                  } else {
                      // Diluar waktu absen yang diizinkan
                      ?>
                      <p class="text-center">Hai, <?=$this->session->userdata('nama')?>, saat ini diluar waktu absen yang diizinkan.</p>
                      <?php
                  }
              } else {
                  ?>
                  <p class="text-center">Hai, <?=$this->session->userdata('nama')?>, Anda sudah absen hari ini.</p>
                  <?php
              }
              ?>
                </div>
                </form>
            </div>
          </section>

          <section class="col-lg-6 ">

            <!-- Map card -->
            <div class="card">
              <div class="card-header"> Waktu Absen </h3>
              </div>
               <div class="card-body">
                  <p class="text-center">Hai, <b><?=$this->session->userdata('nama')?></b> Jangan lupa absen setiap hari Batas jam 07:00-09:00 WIB<br><br></p>
                </div>
            </div>
          </section>

        </div>
      </div>
    </section>
    
          