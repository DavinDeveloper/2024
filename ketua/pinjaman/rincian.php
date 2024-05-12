<?
include '../../libs/main/config.php';
include '../session.php';
$check_angsuran = mysqli_query($db, "SELECT * FROM angsuran WHERE id_pinjaman = '".$_GET['1']."' ORDER BY id ASC");
if (mysqli_num_rows($check_angsuran) == 0) {
    header("Location: ".cfg(url)."bendahara/pinjaman");
}
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
									<div class="card-title">Angsuran Pinjaman ID<? echo $_GET['1']; ?></div>
								</div>
									<div class="card-body">
										<div class="table-responsive">
                                        <table class="table" id="tables">
											<thead>
												<tr>
													<th scope="col">#</th>
													<th scope="col">ID Pinjaman</th>
													<th scope="col">Anggota</th>
													<th scope="col">Nama</th>
													<th scope="col">Bulan</th>
													<th scope="col">Nominal</th>
													<th scope="col">Total Pinjaman</th>
													<th scope="col">Pembayaran Ke</th>
													<th scope="col">Pembayaran</th>
													<th scope="col">Invoice</th>
												</tr>
											</thead>
											<tbody>
											    <?
											    $no = 1;
											    $check_angsuran = mysqli_query($db, "SELECT * FROM angsuran WHERE id_pinjaman = '".$_GET['1']."' ORDER BY id ASC");
											    while($data_angsuran = mysqli_fetch_assoc($check_angsuran)) {
                                                    $data_pengguna = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE username = '".$data_angsuran['username']."'"));
											    ?>
												<tr>
													<td><? echo $no++; ?></td>
													<td>ID<? echo $data_angsuran['id_pinjaman']; ?></td>
													<td><? echo $data_angsuran['username']; ?></td>
													<td><? echo $data_pengguna['nama']; ?></td>
													<td><? echo $data_angsuran['bulan']; ?></td>
													<td>Rp<? echo number_format($data_angsuran['nominal'],0,',','.'); ?></td>
													<td>Rp<? echo number_format($data_angsuran['total_pinjaman'],0,',','.'); ?></td>
													<td><? echo $data_angsuran['pembayaran_ke']; ?></td>
													<td><? echo $data_angsuran['tipe']; ?></td>
													<td>
													    <? if ($data_angsuran['status'] == 'Dibayar') { ?>
													    <a class="btn btn-primary" href="<? echo cfg(url); ?>pinjaman/<? echo $data_angsuran['id']; ?>" target="_BLANK">Lihat</a>
													    <? } else { ?>
													    <button class="btn btn-outline-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false"><? echo $data_angsuran['status']; ?></button>
													    <? } ?>
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