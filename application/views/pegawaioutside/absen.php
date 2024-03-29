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
                <table id="table" class="table table-bordered table-striped text-center">
                    <thead>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Waktu</th>
                      <th>Keterangan</th>
                      <th>Apa yang dilakukan hari ini</th>
                      <th>Apa kendala yang ditemukan hari ini</th>
                      <th>Bagaimana cara mengatasinya</th>
                      <th>Apa kegiatan hari berikutnya</th>
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