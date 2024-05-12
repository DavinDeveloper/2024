<?
include '../../libs/main/config.php';
include '../session.php';
include '../../libs/main/header.php';
?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="row">
				<div class="col-md-12">
					<div class="card-body ">
						<div class="card">
								<div class="card-header">
									<div class="card-title">Pinjaman Saya</div>
								</div>
									<div class="card-body">
										<div class="table-responsive">
                                        <table class="table" id="tables">
											<thead>
												<tr>
													<th scope="col">#</th>
													<th scope="col">ID Pinjaman</th>
													<th scope="col">Nominal</th>
													<th scope="col">Angsuran</th>
													<th scope="col">Keperluan</th>
													<th scope="col">Sisa</th>
													<th scope="col">Status Lunas</th>
													<th scope="col">Status Pengajuan</th>
													<th scope="col">Surat</th>
												</tr>
											</thead>
											<tbody>
											    <?
											    $no = 1;
											    $check_pinjaman = mysqli_query($db, "SELECT * FROM pinjaman WHERE username = '".$user['username']."' ORDER BY id ASC");
											    while($data_pinjaman = mysqli_fetch_assoc($check_pinjaman)) {
											        $sisa_angsuran = mysqli_num_rows(mysqli_query($db, "SELECT * FROM angsuran WHERE id_pinjaman = '".$data_pinjaman['id']."' AND status != 'Dibayar'"));
											        if ($data_pinjaman['pengajuan'] == 'Menunggu' OR $data_pinjaman['pengajuan'] == 'Ditolak') {
											            $sisa_bulan = $data_pinjaman['pengajuan'];
											        } else if ($sisa_angsuran == 0) {
											            $sisa_bulan = 'Lunas';
											        } else {
											            $sisa_bulan = $sisa_angsuran.' Bulan';
											        }
											    ?>
												<tr>
													<td><? echo $no++; ?></td>
													<td>
													    <? if ($data_pinjaman['pengajuan'] == 'Dikonfirmasi') { ?>
													    <a class="btn btn-primary" href="<? echo cfg(url); ?>anggota/pinjaman/rincian?1=<? echo $data_pinjaman['id']; ?>">ID<? echo $data_pinjaman['id']; ?></a>
													    <? } else { ?>
													    <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">ID<? echo $data_pinjaman['id']; ?></button>
													    <? } ?>
													</td>
													<td>Rp<? echo number_format($data_pinjaman['nominal'],0,',','.'); ?></td>
													<td><? echo $data_pinjaman['angsuran']; ?> Bulan</td>
													<td><? echo $data_pinjaman['keperluan']; ?></td>
													<td><? echo $sisa_bulan; ?></td>
													<td><? echo $data_pinjaman['status']; ?></td>
													<td>
													    <?if ($data_pinjaman['pengajuan'] == 'Ditolak') { ?>
    													  <div class="modal fade" id="modal<? echo $data_pinjaman['pengajuan']; ?>" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <h5 class="modal-title" id="modalLongTitle">Alasan</h5>
                                                              <button
                                                                type="button"
                                                                class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"
                                                              ></button>
                                                            </div>
                                                            <div class="modal-body">
                                                              <p>
                                                                <? echo nl2br(str_replace(‘‘, ‘‘, htmlspecialchars($data_pinjaman['alasan']))); ?>
                                                              </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                Close
                                                              </button>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="modal" data-bs-target="#modal<? echo $data_pinjaman['pengajuan']; ?>"><? echo $data_pinjaman['pengajuan']; ?></button>
                                                    <? } else { ?>
													    <? echo $data_pinjaman['pengajuan']; ?>
													    <? } ?>
													</td>
													<td>
													    <a class="btn btn-primary" target="_BLANK" href="<? echo cfg(url); ?>pengajuan/<? echo $data_pinjaman['id']; ?>">Lihat</a>
													</td>
												</tr>
												<? } ?>
											</tbody>
										</table>
									</div>
									</div>
								</div>
							</div>
						</div>
					</div>

<?
include '../../libs/main/footer.php';
?>