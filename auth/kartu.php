<?
include '../libs/main/config.php';
include '../anggota/session.php';
include '../libs/main/header.php';
?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-md-12">
                      <div class="card mb-4">
                        <h5 class="card-header">Kartu Keanggotaan</h5>
                        
              <div class="card">
                <div class="table-responsive text-nowrap">
                  <table class="table table-striped">
                    <tbody>
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Nama</strong></td>
                        <td><? echo $user['nama']; ?></td>
                      </tr>
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Username</strong></td>
                        <td><? echo $user['username']; ?></td>
                      </tr>
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Tempat Lahir</strong></td>
                        <td><? echo $user['tempat_lahir']; ?></td>
                      </tr>
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Tanggal Lahir</strong></td>
                        <td><? echo $user['tanggal_lahir']; ?></td>
                      </tr>
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Pekerjaan</strong></td>
                        <td><? echo $user['pekerjaan']; ?></td>
                      </tr>
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Alamat</strong></td>
                        <td><? echo $user['alamat']; ?></td>
                      </tr>
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>WhatsApp</strong></td>
                        <td><? echo $user['whatsapp']; ?></td>
                      </tr>
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Keanggotaan</strong></td>
                        <td><? echo $user['pinjaman']; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
                    </div>
                </div>
            </div>
<?
include '../libs/main/footer.php';
?>