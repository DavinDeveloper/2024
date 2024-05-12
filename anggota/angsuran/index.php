<?
include '../../libs/main/config.php';
include 'session.php';
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
									<div class="card-title">Angsuran Saya</div>
								</div>
									<div class="card-body">
										<div class="table-responsive">
                                        <table class="table" id="tables">
											<thead>
												<tr>
													<th scope="col">#</th>
													<th scope="col">Bulan</th>
													<th scope="col">Nominal</th>
												</tr>
											</thead>
											<tbody>
											    <?
                                                $grouped_data = array();
                                                $no = 1;
                                                $check_angsuran = mysqli_query($db, "SELECT * FROM angsuran WHERE username = '".$user['username']."' AND status != 'Dibayar' ORDER BY bulan ASC");
                                                while($data_angsuran = mysqli_fetch_assoc($check_angsuran)) {
                                                    $bulan = $data_angsuran['bulan'];
                                                    if(!isset($grouped_data[$bulan])) {
                                                        $grouped_data[$bulan] = array(
                                                            'total_nominal' => 0,
                                                            'details' => array()
                                                        );
                                                    }
                                                    $grouped_data[$bulan]['total_nominal'] += $data_angsuran['nominal'];
                                                    $grouped_data[$bulan]['details'][] = $data_angsuran;
                                                }
                                                ?>
												<? foreach($grouped_data as $bulan => $group): ?>
                                                    <tr>
                                                        <td><? echo $no++; ?></td>
                                                        <td><a class="btn btn-primary" href="<? echo cfg(url); ?>anggota/angsuran/rincian?1=<? echo $bulan; ?>"><? echo $bulan; ?></a></td>
                                                        <td>Rp<? echo number_format($group['total_nominal'], 0, ',', '.'); ?></td>
                                                    </tr>
                                                <? endforeach; ?>
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