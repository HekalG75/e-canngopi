<script type="text/javascript">
var z;
window.onload = function() {
  getLocation();
};

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else {
    alert("Browser kamu tidak support GPS :(");
  }
}

function calculateDistance(lat1, lon1, lat2, lon2) {
    const R = 6371000; // Radius Bumi dalam meter (1 kilometer = 1000 meter)
    const dLat = (lat2 - lat1) * (Math.PI / 180);
    const dLon = (lon2 - lon1) * (Math.PI / 180);
    const a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(lat1 * (Math.PI / 180)) * Math.cos(lat2 * (Math.PI / 180)) *
        Math.sin(dLon / 2) * Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    const distance = R * c; // Jarak dalam meter
    return distance;
}

function showPosition(position) {
  const targetLat = -6.2380256;
  const targetLon = 106.6124749;
  const userLat = position.coords.latitude;
  const userLon = position.coords.longitude;

  // Tentukan radius dalam meter
  const radius = 1000.0;

  // Hitung jarak antara pengguna dan lokasi target
  const distance = calculateDistance(userLat, userLon, targetLat, targetLon);

  if (distance <= radius) {
    alert("kamu didalam Wilayah CanNgopi");
    document.getElementById("lok").value = "1";
  } else {
    alert("kamu diluar Wilayah CanNgopi!");
    document.getElementById("lok").value = "0";
  }
}

function showError(error) {
  switch (error.code) {
    case error.PERMISSION_DENIED:
      alert("Pengguna menolak permintaan Geolocation.");
      break;
    case error.POSITION_UNAVAILABLE:
      alert("Informasi lokasi tidak tersedia.");
      break;
    case error.TIMEOUT:
      alert("Permintaan untuk mendapatkan lokasi pengguna telah berakhir.");
      break;
    case error.UNKNOWN_ERROR:
      alert("Terjadi kesalahan yang tidak diketahui.");
      break;
  }
}
</script>

<section class="col-lg-12 connectedSortable">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Absen ini menggunakan sistem <b>GEOFENCING</b> (hanya bisa absen jika didalam area Canngopi-Kampus Pradita) <br>
              Harap beri izin <b>akses lokasi</b> pada browser kamu, agar sistem bisa tau lokasi kamu <br>
              Apabila ada kesalahan lokasi silahkan cek ulang lokasi dengan menekan tombol dibawah<br>
              <button class="btn btn-primary" onclick="getLocation()">Cek lokasi</button><br>
              Jika terjadi masalah coba ganti device kamu dengan device yang lain<br>
              dan jika masih bermasalah silahkan hubungi admin.
            </div>
</section>

<section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

          <section class="col-lg-6 connectedSortable">
            <!-- Map card -->
            <div class="card"> 
              <div class="card-header"> Notifikasi </h3>
              </div>
              <form method="post" action="pegawai/proses_absen">
               <div class="card-body">
                  <?php if ($waktu != 'dilarang') { ?>
                  <p class="text-center">Hai, <?=$this->session->userdata('nama')?> anda hari ini belum melakukan absen <b><?=$waktu?></b>. Silahkan lakukan absen pada tombol absen berikut <br><br>
                  <button class="btn btn-primary">Absen <?=$waktu?></button></p>
                  <input type="hidden" name="ket" id="ket" value="<?=$waktu?>">
                      <input type="hidden" name="lok" id="lok" value="1">
                    <?php } else { ?>
                  <p class="text-center">Hai, <?=$this->session->userdata('nama')?> anda hari ini sudah melakukan absensi <b>Masuk</b> dan <b>Pulang</b></p>
                  <?php }  ?>
                </div>
                </form>
            </div>
          </section>

          <section class="col-lg-6 connectedSortable">

            <!-- Map card -->
            <div class="card">
              <div class="card-header"> Waktu Absen </h3>
              </div>
               <div class="card-body">
                  <p class="text-center">Hai, <b><?=$this->session->userdata('nama')?></b> Jangan lupa absen setiap hari jam 07:00 WIB<br> dan absen pulang jam 21:00 PM <br><br></p>
                </div>
            </div>
          </section>

        </div>
      </div>
    </section>
    
          