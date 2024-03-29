    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

          <section class="col-lg-12 connectedSortable">

            <!-- Map card -->
            <div class="card">
              <div class="card-header"> <?=$title?> </h3>
              </div>
              <form method="post" action="<?=base_url('superadmin/pegawai_update/'.$detail->nim)?>">
                <div class="card-body">
                  <div class="form-group">
                    <label>NIM</label>
                    <input type="text" name="nim" value="<?=$detail->nim?>" class="form-control" required="" readonly>
                  </div>
                  <div class="form-group">
                    <label>Level</label>
                    <select name="level" class="form-control">
                      <option value="" selected="" disabled="">Pilih Level</option>
                      <option <?php if ($detail->level == 'pegawai') {echo 'selected'; }?> value="pegawai">Pegawai</option>
                      <option <?php if ($detail->level == 'pegawaioutside') {echo 'selected'; }?> value="pegawaioutside">PegawaiOutSide</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" value="<?=$detail->nama?>" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?=$detail->email?>" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                      <option value="" selected="" disabled="">Pilih Jenis Kelamin</option>
                      <option <?php if ($detail->jenis_kelamin == 'L') {echo 'selected'; }?> value="L">Laki-Laki</option>
                      <option <?php if ($detail->jenis_kelamin == 'P') {echo 'selected'; }?> value="P">Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Jabatan</label>
                    <select name="departemen" class="form-control">
                      <option value="" selected="" disabled="">Pilih Jabatan</option>
                      <?php foreach ($data as $d) { ?>
                      <option <?php if ($detail->id_departemen == $d->departemen_id) {echo "selected";}?> value="<?=$d->departemen_id?>"><?=$d->departemen?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Waktu masuk</label>
                    <input type="date" name="masuk" value="<?=$detail->waktu_masuk?>" class="form-control" required="">
                  </div>
                  
                <div class="card-footer">
                  <a href="<?=base_url('superadmin/pegawai')?>" class="btn btn-danger">Kembali</a>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
          </section>
        </div>
      </div>
    </section>