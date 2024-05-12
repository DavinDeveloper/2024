<?
include '../../lib/config.php';
if ($user['status'] != 'Admin') {
    header("Location: ".cfg(url)."dashboard");
}
include '../lib/header.php';
?>
			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Pembelian Pengguna</h4>
						<div class="row">
							<div class="col-md-12">
									<div class="card-body ">
								    <div class="card">
									<div class="card-header">
										<div class="card-title">Seluruh Pembelian</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
                                        <table class="table" id="tables">
											<thead>
												<tr>
													<th scope="col">#</th>
													<th scope="col">Nama Paket</th>
													<th scope="col">Harga</th>
													<th scope="col">Pengguna</th>
													<th scope="col">Bukti Transfer</th>
													<th scope="col">Status</th>
													<th scope="col">Waktu</th>
													<th scope="col">Aksi</th>
												</tr>
											</thead>
											<tbody>
											    <?
											    $no = 1;
											    $check_pembelian = mysqli_query($db, "SELECT * FROM pembelian ORDER BY id ASC");
											    while($data_pembelian = mysqli_fetch_assoc($check_pembelian)) {
											    ?>
												<tr>
													<td><? echo $no++; ?></td>
													<td><? echo $data_pembelian['produk']; ?></td>
													<td>Rp<? echo number_format($data_pembelian['harga'],0,',','.'); ?></td>
													<td><? echo $data_pembelian['username']; ?></td>
													<td>
													    <? if (!empty($data_pembelian['bukti'])) { ?>
													    <a href="<? echo $data_pembelian['bukti']; ?>" class="btn btn-primary" target="_BLANK">Lihat</a>
													    <? } else { ?>
													    <a href="#" class="btn btn-primary">Belum Ada</a>
													    <? } ?>
													</td>
													<td><? echo $data_pembelian['status']; ?></td>
													<td><? echo $data_pembelian['datetime']; ?></td>
													<td>
													    <? if ($data_pembelian['status'] == 'Pembayaran Dikonfirmasi') { ?>
													    <a href="<? echo cfg(url); ?>invoice/<? echo $data_pembelian['id']; ?>" class="btn btn-primary" target="_BLANK">Invoice</a>
													    <? } else if ($data_pembelian['status'] == 'Dibatalkan') { ?>
													    <a href="#" class="btn btn-secondary">Dibatalkan</a>
													    <? } else if (!empty($data_pembelian['bukti'])) { ?>
													    <a href="<? echo cfg(url); ?>dashboard/pembelian/tolak?1=<? echo $data_pembelian['id']; ?>" class="btn btn-danger">Tolak</a>
													    <a href="<? echo cfg(url); ?>dashboard/pembelian/konfirmasi?1=<? echo $data_pembelian['id']; ?>" class="btn btn-success">Konfirmasi</a>
													    <? } else if (empty($data_pembelian['bukti'])) { ?>
													    <a href="<? echo cfg(url); ?>dashboard/pembelian/batalkan?1=<? echo $data_pembelian['id']; ?>" class="btn btn-warning">Batalkan</a>
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
				</div>
				</div>
			</div>
<?
include '../lib/footer.php';
?>