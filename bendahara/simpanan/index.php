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
									<div class="card-title">Daftar Anggota</div>
								</div>
									<div class="card-body">
										<div class="table-responsive">
                                        <table class="table" id="tables">
											<thead>
												<tr>
													<th scope="col">#</th>
													<th scope="col">Anggota</th>
													<th scope="col">Nama</th>
													<th scope="col">Total Simpanan</th>
													<th scope="col">Simpanan Lunas</th>
													<th scope="col">Simpanan Belum Lunas</th>
												</tr>
											</thead>
											<tbody>
											    <?
											    $no = 1;
											    $check_anggota = mysqli_query($db, "SELECT * FROM users WHERE status = 'Anggota' ORDER BY id ASC");
											    while($data_anggota = mysqli_fetch_assoc($check_anggota)) {
											        $total_simpanan = mysqli_fetch_assoc(mysqli_query($db, "SELECT SUM(nominal) AS total FROM simpanan WHERE username = '".$data_anggota['username']."'"));
                                                    $lunas_simpanan = mysqli_fetch_assoc(mysqli_query($db, "SELECT SUM(nominal) AS total FROM simpanan WHERE status = 'Dibayar' AND username = '".$data_anggota['username']."'"));
                                                    $belum_simpanan = mysqli_fetch_assoc(mysqli_query($db, "SELECT SUM(nominal) AS total FROM simpanan WHERE status != 'Dibayar' AND username = '".$data_anggota['username']."'"));
                                                ?>
												<tr>
													<td><? echo $no++; ?></td>
													<td><a class="btn btn-primary" href="<? echo cfg(url); ?>bendahara/simpanan/rincian?1=<? echo $data_anggota['username']; ?>"><? echo $data_anggota['username']; ?></a></td>
													<td><? echo $data_anggota['nama']; ?></td>
													<td>Rp<? echo number_format($total_simpanan['total'],0,',','.'); ?></td>
													<td>Rp<? echo number_format($lunas_simpanan['total'],0,',','.'); ?></td>
													<td>Rp<? echo number_format($belum_simpanan['total'],0,',','.'); ?></td>
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