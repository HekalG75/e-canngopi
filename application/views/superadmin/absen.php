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
          <a onclick="return confirm('Apakah Anda yakin ingin menghapus semua data absensi?')" href="<?=base_url('superadmin/hapus_semua')?>" class="btn btn-danger btn-sm float-right"><span class="fa fa-trash"></span> Hapus Semua Data</a>
        </div>


                      <th>No</th> 
                      <th>Nama</th>
                      <th>Waktu</th>
                      <th>Keterangan</th>
                      <th>Apa yang dilakukan hari ini</th>
                      <th>Apa kendala yang ditemukan hari ini</th>
                      <th>Bagaimana cara mengatasinya</th>
                      <th>Apa kegiatan hari berikutnya</th>
                      <th>Opsi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; foreach ($data as $d) { ?>
                      <tr>
                        <td width="1%"><?=$no++?></td>
                        <td><?=ucfirst($d->nama)?></td>
                        <td><?=ucfirst($d->waktu)?></td>
                        <td><?=ucfirst($d->keterangan)?></td>
                        <td><?=ucfirst($d->kegiatanhariini)?></td>
                        <td><?=ucfirst($d->kendala)?></td>
                        <td><?=ucfirst($d->mengatasi)?></td>
                        <td><?=ucfirst($d->kegiatanberikut)?></td>
                        <td> <a onclick="return confirm('apakah anda yakin ingin menghapus absensi pegawai ini?')" href="<?=base_url('superadmin/absen_delete/'.$d->nim)?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <!-- Import Button -->
                  <button id="importButton" class="btn btn-primary btn-sm float-left"><span class="fa fa-upload"></span> Import Data</button>
              </div>
            </div>
              <!-- Modal -->
              <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <p>Select a file to upload:</p>
                              <form id="uploadForm" enctype="multipart/form-data">
                                  <div class="form-group">
                                      <input type="file" class="form-control-file" id="fileInput" accept=".csv, .xlsx">
                                  </div>
                              </form>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" id="confirmUploadButton" class="btn btn-primary">Upload</button>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
          <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
          <script>
        $(document).ready(function() {
            // Handle the click event of the import button
            $('#importButton').click(function() {
                $('#uploadModal').modal('show'); // Show the modal
            });

            // Handle the click event of the confirm upload button in the modal
            $('#confirmUploadButton').click(function() {
                $('#uploadForm').submit(); // Submit the form
            });
        });
    </script>
        </div>
      </div>
    </section>