    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

          <section class="col-lg-12 connectedSortable">

            <!-- Map card -->
            <div class="card">
              <div class="card-header"> <?=$title?> </h3>
              </div>
              <!-- Modal -->
                <div class="modal fade" id="modalfilter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header bg-success">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-search"></i>Filter Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="" method="post">
                          <div class="form-group">
                            <label for="tgl_awal">Tanggal Awal</label>
                            <input type="date" name="tgl_awal" id="tgl_awal" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="tgl_akhir">Tanggal Akhir</label>
                            <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success btn-sm"  name="filter">Submit</button>
                           </div>
                        </form>
                      </div>
                      
                    </div>
                  </div>
                </div>
              <div class="card-body table-responsive">
                <table id="myTable" class="table table-bordered table-striped text-center">
                    <thead>
                      <button type="button" class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#modalfilter">Filter Data</button>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Waktu</th>
                      <th>Keterangan</th>
                      <th>Opsi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; foreach ($data as $d) { ?>
                      <tr>
                        <td width="1%"><?=$no++?></td>
                        <td><?=ucfirst($d->nama)?></td>
                        <td><?=ucfirst($d->waktu)?></td>
                        <td><?=ucfirst($d->keterangan)?></td>
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