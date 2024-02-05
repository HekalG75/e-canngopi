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
                      <th width="1%">No</th>
                      <th>Nama</th>
                      <th>Jenis</th>
                      <th>Waktu</th>
                      <th>Keterangan</th>
                      <th>Status</th>
                      <th>Opsi</th> 
                      <th>Alasan Penolakan</th>
                    </thead>
                    <tbody>
                      <?php $no=1; foreach ($data as $d) { 
                        $cek = $this->db->query(" select min(tanggal) as mulai,max(tanggal) as akhir from detailcuti where id_cuti = '$d->id_cuti' ")->row();
                      ?>
                      <tr>
                        <td width="1%"><?=$no++?></td>
                        <td><?=ucfirst($d->nama)?></td>
                        <td><?=ucfirst($d->jenis_cuti)?></td>
                        <td><?=date('d/m/Y', strtotime($cek->mulai))?> - <?=date('d/m/Y', strtotime($cek->akhir))?></td>
                        <td>
                          <?=ucfirst($d->alasan)?><br>
                          <?php if ($d->jenis_cuti == 'sakit') { ?>
                            <small>Bukti  <a target="_blank" href="<?=base_url('bukti/'.$d->bukti)?>" >Klik disini</a></small>
                          <?php } ?>
                        </td>
                        <td><?=ucfirst($d->status)?></td>
                        <td>
                          <?php if ($d->status == 'diajukan') { ?>
                          <a onclick="return confirm('apakah anda yakin ingin menerima pengajuan cuti ini?')" href="<?=base_url('admin/cuti_terima/'.$d->id_cuti)?>" class="btn btn-primary btn-sm"><span class="fa fa-check"></span></a>
                          <!-- Tambahkan modal untuk memasukkan alasan penolakan -->
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#alasanModal<?=$d->id_cuti?>"><span class="fa fa-trash"></span></button>

                          <?php } ?>
                           <?php if ($d->status == 'diterima') { ?>
                            <button class="btn btn-primary btn-sm">Anda menerima pengajuan</button>
                          <?php } ?>
                          <?php if ($d->status == 'ditolak') { ?>
                            <button class="btn btn-danger btn-sm">Anda menolak pengajuan</button>
                            <br>
                            <strong>Alasan Penolakan:</strong> <?=$d->alasan_penolakan?> <!-- Menampilkan alasan penolakan -->
                          <?php } ?>
                        </td>
                      </tr>
                      <!-- Tambahkan modal -->
                        <div class="modal fade" id="alasanModal<?=$d->id_cuti?>" tabindex="-1" role="dialog" aria-labelledby="alasanModalLabel<?=$d->id_cuti?>" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="alasanModalLabel<?=$d->id_cuti?>">Masukkan Alasan Penolakan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="<?=base_url('admin/cuti_tolak')?>" method="post">
                                  <input type="hidden" name="id_cuti" value="<?=$d->id_cuti?>">
                                  <div class="form-group">
                                    <label for="alasan_penolakan">Alasan Penolakan:</label>
                                    <textarea class="form-control" name="alasan_penolakan" required></textarea>
                                  </div>
                                  <button type="submit" class="btn btn-danger">Kirim</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                    </tbody>
                  </table>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>