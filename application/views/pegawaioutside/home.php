
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
              <form method="post" action="pegawaioutside/proses_absen">
               <div class="card-body">
                  <?php if ($waktu != 'dilarang') { ?>
                  <p class="text-center">Hai, <?=$this->session->userdata('nama')?> anda hari ini belum melakukan absen <b><?=$waktu?></b>. Silahkan lakukan absen pada tombol absen berikut <br><br>
                  <button class="btn btn-primary">Absen <?=$waktu?></button></p>
                  <input type="hidden" name="ket" id="ket" value="<?=$waktu?>">
                      <input type="hidden" name="lok" id="lok" value="1">
                    <?php } else { ?>
                  <p class="text-center">Hai, <?=$this->session->userdata('nama')?> anda hari ini sudah melakukan absensi <b>Masuk</b>dan <b>Pulang</b></p>
                  <?php }  ?>
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
    
          