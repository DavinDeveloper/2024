<?
include '../../libs/main/config.php';
include '../session.php';
$check_simpanan = mysqli_query($db, "SELECT * FROM simpanan WHERE username = '".$_GET['1']."' ORDER BY id ASC");
if (mysqli_num_rows($check_simpanan) == 0) {
    header("Location: ".cfg(url)."ketua/simpanan");
} else {
    $data_user = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE username = '".$_GET['1']."'"));
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
									<div class="card-title">Rincian Simpanan <? echo $data_user['nama']; ?></div>
								</div>
									<div class="card-body">
										<div class="table-responsive">
                                        <table class="table" id="tables">
											<thead>
												<tr>
													<th scope="col">#</th>
													<th scope="col">Bulan</th>
													<th scope="col">Nominal</th>
													<th scope="col">Jenis</th>
													<th scope="col">Pembayaran</th>
													<th scope="col">Membayar</th>
													<th scope="col">Invoice</th>
												</tr>
											</thead>
											<tbody>
											    <?
											    $no = 1;
											    $check_simpanan = mysqli_query($db, "SELECT * FROM simpanan WHERE username = '".$_GET['1']."' ORDER BY id ASC");
											    while($data_simpanan = mysqli_fetch_assoc($check_simpanan)) {
                                                    $data_pengguna = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE username = '".$data_simpanan['username']."'"));
											    ?>
												<tr>
													<td><? echo $no++; ?></td>
													<td><? echo $data_simpanan['bulan']; ?></td>
													<td>Rp<? echo number_format($data_simpanan['nominal'],0,',','.'); ?></td>
													<td><? echo $data_simpanan['jenis']; ?></td>
													<td><? echo $data_simpanan['tipe']; ?></td>
													<td><? echo $data_simpanan['status']; ?></td>
													<td>
													    <? if ($data_simpanan['status'] == 'Dibayar') { ?>
													    <a class="btn btn-primary" href="<? echo cfg(url); ?>simpanan/<? echo $data_simpanan['id']; ?>" target="_BLANK">Lihat</a>
													    <? } else { ?>
													    <button class="btn btn-outline-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false"><? echo $data_simpanan['status']; ?></button>
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