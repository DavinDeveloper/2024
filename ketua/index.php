            <?
            if ($user['status'] == 'Ketua') {
                $check_simpanan = mysqli_query($db, "SELECT SUM(nominal) AS total_simpanan FROM simpanan WHERE tipe != 'Belum Dibayar'");
                $data_simpanan = mysqli_fetch_assoc($check_simpanan);
                $total_simpanan = $data_simpanan['total_simpanan'];
                $check_pinjaman = mysqli_query($db, "SELECT SUM(nominal) AS total_pinjaman FROM pinjaman WHERE status != 'Belum Lunas'");
                $data_pinjaman = mysqli_fetch_assoc($check_pinjaman);
                $total_pinjaman = $data_pinjaman['total_pinjaman'];
            ?>
            
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                
                <!--/ Total Revenue -->
                <div class="col-12 col-md-8 col-lg-12 order-3 order-md-2">
                  <div class="row">
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded" />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt4"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                              </div>
                            </div>
                          </div>
                          <span class="d-block mb-1">Semua Simpanan</span>
                          <h3 class="card-title text-nowrap mb-2">Rp<? echo number_format($total_simpanan,0,',','.'); ?></h3>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt1"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Semua Pinjaman</span>
                          <h3 class="card-title mb-2">Rp<? echo number_format($total_pinjaman,0,',','.'); ?></h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <? } ?>