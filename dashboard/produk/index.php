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
						<h4 class="page-title">Produk</h4>
						<div class="row">
							<div class="col-md-12">
									<div class="card-body ">
								    <div class="card">
									<div class="card-header">
										<div class="card-title"><a href="<? echo cfg(url); ?>dashboard/produk/tambah" class="btn btn-primary">Tambah</a></div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
                                        <table class="table" id="tables">
											<thead>
												<tr>
													<th scope="col">#</th>
													<th scope="col">Nama Paket</th>
													<th scope="col">Harga</th>
													<th scope="col">Aksi</th>
												</tr>
											</thead>
											<tbody>
											    <?
											    $no = 1;
											    $check_produk = mysqli_query($db, "SELECT * FROM produk ORDER BY id ASC");
											    while($data_produk = mysqli_fetch_assoc($check_produk)) {
											    ?>
												<tr>
													<td><? echo $no++; ?></td>
													<td><? echo $data_produk['nama']; ?></td>
													<td>Rp<? echo number_format($data_produk['harga'],0,',','.'); ?></td>
													<td>
													    <a href="<? echo cfg(url); ?>dashboard/produk/edit?1=<? echo $data_produk['id']; ?>" class="btn btn-warning">Edit</a>
													    <a href="<? echo cfg(url); ?>dashboard/produk/delete?1=<? echo $data_produk['id']; ?>" class="btn btn-danger">Hapus</a>
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