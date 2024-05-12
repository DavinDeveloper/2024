<?
include '../../libs/main/config.php';
include '../session.php';
include '../../libs/main/header.php';
?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
    				<div class="col-md-12">
						<div class="card">
								<div class="card-body">
                                      <div class="row">
                                        <!-- Basic List group -->
                                        <div class="col-lg-12 mb-4 mb-xl-0">
                                          <small class="text-light fw-semibold">Download Laporan</small>
                                          <div class="demo-inline-spacing mt-3">
                                            <div class="list-group">
                                              <a href="<? echo cfg(url); ?>ketua/laporan/simpanan" class="list-group-item list-group-item-action">Simpanan</a>
                                              <a href="<? echo cfg(url); ?>ketua/laporan/pinjaman" class="list-group-item list-group-item-action">Pinjaman</a>
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
include '../../libs/main/footer.php';
?>