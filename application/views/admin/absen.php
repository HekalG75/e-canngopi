    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

          <section class="col-lg-12 connectedSortable">

            <!-- Map card -->
            <div class="card">
              <div class="card-header"> <?=$title?> </h3>
              </div>
              
              <div class="card-body table-responsive">
                <table id="myTable" class="table table-bordered table-striped text-center">
                    <thead>
                      <!-- Tombol hapus semua data absen -->
          <a onclick="return confirm('Apakah Anda yakin ingin menghapus semua data absensi?')" href="<?=base_url('admin/hapus_semua')?>" class="btn btn-danger btn-sm float-right"><span class="fa fa-trash"></span> Hapus Semua Data</a>
        </div>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Waktu</th>
                      <th>Keterangan</th>
                      <th>Catatan</th>
                      <th>Opsi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; foreach ($data as $d) { ?>
                      <tr>
                        <td width="1%"><?=$no++?></td>
                        <td><?=ucfirst($d->nama)?></td>
                        <td><?=ucfirst($d->waktu)?></td>
                        <td><?=ucfirst($d->keterangan)?></td>
                        <td><?=ucfirst($d->catatan)?></td>
                        <td> <a onclick="return confirm('apakah anda yakin ingin menghapus absensi pegawai ini?')" href="<?=base_url('admin/absen_delete/'.$d->nim)?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>