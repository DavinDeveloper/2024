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
									<div class="card-title"><a href="<? echo cfg(url); ?>ketua/bendahara/tambah" class="btn btn-outline-primary">Tambah Bendahara</a></div>
								</div>
									<div class="card-body">
										<div class="table-responsive">
                                        <table class="table" id="tables">
											<thead>
												<tr>
													<th scope="col">#</th>
													<th scope="col">ID Bendahara</th>
													<th scope="col">Bendahara</th>
													<th scope="col">Nama</th>
													<th scope="col">Status</th>
												</tr>
											</thead>
											<tbody>
											    <?
											    $no = 1;
											    $check_anggota = mysqli_query($db, "SELECT * FROM users WHERE status = 'Bendahara' ORDER BY id ASC");
											    while($data_anggota = mysqli_fetch_assoc($check_anggota)) {
											        $total_simpanan = mysqli_fetch_assoc(mysqli_query($db, "SELECT SUM(nominal) AS total FROM simpanan WHERE username = '".$data_anggota['username']."'"));
											        $total_pinjaman = mysqli_fetch_assoc(mysqli_query($db, "SELECT SUM(nominal) AS total FROM pinjaman WHERE username = '".$data_anggota['username']."'"));
											    ?>
												<tr>
													<td><? echo $no++; ?></td>
													<td>
													<button class="btn btn-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">ID<? echo $data_anggota['id']; ?></button>
    												</td>
													<td><? echo $data_anggota['username']; ?></td>
													<td><? echo $data_anggota['nama']; ?></td>
													<td>
													<button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <? echo $data_anggota['keanggotaan']; ?>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="<? echo cfg(url); ?>ketua/bendahara/keanggotaan?1=<? echo $data_anggota['id']; ?>&2=Aktif">Aktif</a></li>
                                                    <li><a class="dropdown-item" href="<? echo cfg(url); ?>ketua/bendahara/keanggotaan?1=<? echo $data_anggota['id']; ?>&2=Nonaktif">Nonaktif</a></li>
                                                    <li><a class="dropdown-item" href="<? echo cfg(url); ?>ketua/bendahara/keanggotaan?1=<? echo $data_anggota['id']; ?>&2=Keluar">Keluar</a></li>
                                                    <li>
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