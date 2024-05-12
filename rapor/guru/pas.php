<?php
session_start();
require("../mainconfig.php");
require("../vendor/index.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

if (isset($_SESSION['user'])) {
    $sess_username = $_SESSION['user']['username'];
    $check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
    $data_user = mysqli_fetch_assoc($check_user);
    
    $semester = $_GET['1'];
    $code = 'pas';

    if (mysqli_num_rows($check_user) == 0) {
        header("Location: " . $cfg_baseurl . "logout.php");
    } else if ($data_user['status'] == "Suspended") {
        header("Location: " . $cfg_baseurl . "logout.php");
    } else if ($data_user['status'] != "Guru") {
        header("Location: " . $cfg_baseurl);
    } else if (empty($semester)) {
        header("Location: " . $cfg_baseurl);
    } else {
        

        include("../lib/header.php");
        if (isset($_POST['import'])) {

            $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            
                    $pelajaran = $_POST['pelajaran'];
                    if (isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {
                        
                        $arr_file = explode('.', $_FILES['berkas_excel']['name']);
                        $extension = end($arr_file);
        
                        if ('csv' == $extension) {
                            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                        } else {
                            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                        }
        
                        $spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);
        
                        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        
                        $sheetData = $spreadsheet->getActiveSheet()->toArray();
                        
                            for ($i = 1; $i < count($sheetData); $i++) {
        
                                
                $nis = $sheetData[$i]['1'];
                $nama = $sheetData[$i]['2'];
        	    $p = $sheetData[$i]['4'];
        	    $k = $sheetData[$i]['5'];
        	    $s = $sheetData[$i]['6'];
        	    $check_nis = mysqli_query($db, "SELECT * FROM ".$code." WHERE nis = '$nis'");
        	    if (mysqli_num_rows($check_nis) == 0 AND !empty($nis)) {
        	        $update = mysqli_query($db, "INSERT INTO ".$code." (nis, nama, s".$semester."_".$pelajaran."_p, s".$semester."_".$pelajaran."_k, s".$semester."_".$pelajaran."_s) VALUES ('$nis', '$nama', '$p', '$k', '$s')");
        	    } else {
        	        $update = mysqli_query($db, "UPDATE ".$code." SET s".$semester."_".$pelajaran."_p = '$p', s".$semester."_".$pelajaran."_k = '$k', s".$semester."_".$pelajaran."_s = '$s' WHERE nis = '$nis'");
        	    }
        	    if ($update == TRUE) {
        		$msg_type = "success";
        		$msg_content = "Nilai berhasil disimpan.";
        		} else {
        	    $msg_type = "error";
        		$msg_content = "<b>Gagal:</b> Error system.";
        			}}
        	}
        } 
        ?>
<div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-uppercase">Import Nilai</div>
                    <div class="form-group col-lg-12"><br />
                    	<div class="col-md-12">
					    <?php
		                if ($msg_type == "success") {
		               	?>
				            <div class="alert alert-success">
				            	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
				                	<i class="fa fa-check-circle"></i>
				            	<?php echo $msg_content; ?>
				            </div>
			            <?php
		            	} else if ($msg_type == "error") {
		            	?>
			            	<div class="alert alert-danger">
			            		<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
				                	<i class="fa fa-times-circle"></i>
				                <?php echo $msg_content; ?>
				            </div>
		            	<?php
		            	}
		            	?>
				    	</div>
                        <form method="post" enctype="multipart/form-data">

                            <select class="form-control" name="pelajaran" id="pelajaran" required>
                                <option value="">-- Pilih Pelajaran --</option>
                                <?php
                                $check = mysqli_query($db, "SELECT * FROM pelajaran WHERE nama = '".$data_user['pelajaran']."' ORDER BY nama ASC");
                                while ($data = mysqli_fetch_assoc($check)) {
                                ?>
                                    <option value="<?php echo $data['code']; ?>"><?php echo $data['nama']; ?></option>
                                <?php } ?>
                            </select>
                            <br>

                            <br>
                            <input class="form-control" name="berkas_excel" type="file" required="required" required>
                            <br>
                            <div class="form-group float-right col-lg-6">
                                <button type="submit" name="import" class="btn btn-block btn-success">Import Nilai</button>
                            </div>

                            <div class="form-group float-left col-lg-6">
                                <a href="<?php echo $cfg_baseurl; ?>guru/data" class="btn btn-block btn-dark">Download Format Nilai</a>
                            </div>
                            
                            <!--<div class="form-group float-left col-lg-6">-->
                            <!--    <a href="data_siswa.xlsx" type="submit" name="pilih" class="btn btn-block btn-dark">Download Data Siswa</a>-->
                            <!--</div>-->

                    </div>

                    </form>

                </div>
            </div>
        </div>

<?php
include("../lib/footer.php");
}
} else {
	header("Location: " . $cfg_baseurl);
}
?> 