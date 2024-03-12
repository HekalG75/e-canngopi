    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

          <section class="col-lg-12 connectedSortable">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Jika anda lupa absen hari sebelumnya, anda bisa langsung mengajukan revisi absen pada menu "Tambah Data".
            </div>
            <!-- Map card -->
            <div class="card">
              <div class="card-header"> <?=$title?> </h3>
                  <a style="float: right;" href="<?=base_url('pegawaioutside/revisi_add')?>" class="btn btn-sm btn-primary">Tambah data</a>
              </div>
              <div class="card-body table-responsive">
                <table id="table" class="table table-bordered table-striped text-center">
                    <thead>
                      <th width="1%">No</th>
                      <th>Nama</th>
                      <th>Waktu</th>
                      <th>Keterangan</th>
                      <th>Status</th>
                    </thead>
                    <tbody>
                      <?php $no=1; foreach ($data as $d) { 
                        $cek = $this->db->query(" select min(tanggal) as mulai,max(tanggal) as akhir from detailrevisi where id_revisi = '$d->id_revisi' ")->row();
                      ?>
                      <tr>
                        <td width="1%"><?=$no++?></td>
                        <td><?=ucfirst($d->nama)?></td>
                        <td>
                          <?=ucfirst($d->keterangan)?><br>
                        </td>
                        <td><?=ucfirst($d->status)?></td>
                        <td>
                          <?php if ($d->status == 'diterima') { ?>
                            <button class="btn btn-primary btn-sm">Pengajuan anda diterima</button>
                          <?php } ?>
                          <?php if ($d->status == 'ditolak') { ?>
                            <button class="btn btn-danger btn-sm">Anda sudah banyak cuti</button>
                            <br>
                            
                          <?php } ?>
                        </td>
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