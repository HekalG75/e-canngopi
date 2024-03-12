<section class="content">
  <div class="container-fluid">
    <!-- Main row -->
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-body">
            <form action="<?= base_url('pegawaioutside/revisi_simpan') ?>" method="post">
              <div class="form-group">
                <label for="tanggal">Tanggal Absen yang Terlupa</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
              </div>
              <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
              </div>
              <div class="card-footer">
                <a href="<?=base_url('pegawaioutside/revisi_absen')?>" class="btn btn-danger">Kembali</a>
                <button class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>