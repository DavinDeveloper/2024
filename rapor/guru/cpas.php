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
        	    $ca = $sheetData[$i]['4'];
        	    $pkl1_dd = $sheetData[$i]['5'];
        	    $pkl1_lks = $sheetData[$i]['6'];
        	    $pkl1_bln = $sheetData[$i]['7'];
        	    $pkl1_n = $sheetData[$i]['8'];
        	    $pkl2_dd = $sheetData[$i]['9'];
        	    $pkl2_lks = $sheetData[$i]['10'];
        	    $pkl2_bln = $sheetData[$i]['11'];
        	    $pkl2_n = $sheetData[$i]['12'];
        	    $pkl3_dd = $sheetData[$i]['13'];
        	    $pkl3_lks = $sheetData[$i]['14'];
        	    $pkl3_bln = $sheetData[$i]['15'];
        	    $pkl3_n = $sheetData[$i]['16'];
        	    $eks1_eks = $sheetData[$i]['17'];
        	    $eks1_n = $sheetData[$i]['18'];
        	    $eks2_eks = $sheetData[$i]['19'];
        	    $eks2_n = $sheetData[$i]['20'];
        	    $eks3_eks = $sheetData[$i]['21'];
        	    $eks3_n = $sheetData[$i]['22'];
        	    $sakit = $sheetData[$i]['23'];
        	    $izin = $sheetData[$i]['24'];
        	    $alfa = $sheetData[$i]['25'];
        	    $kenaikan = $sheetData[$i]['26'];
        	    $integritas = $sheetData[$i]['27'];
        	    $religius = $sheetData[$i]['28'];
        	    $nasionalis = $sheetData[$i]['29'];
        	    $mandiri = $sheetData[$i]['30'];
        	    $gotongroyong = $sheetData[$i]['31'];
        	    $cpk = $sheetData[$i]['32'];
        	    $pres_k1 = $sheetData[$i]['33'];
        	    $pres_k2 = $sheetData[$i]['34'];
        	    $pres_k3 = $sheetData[$i]['35'];
        	    $pres_ek1 = $sheetData[$i]['36'];
        	    $pres_ek2 = $sheetData[$i]['37'];
        	    $pres_ek3 = $sheetData[$i]['38'];
        	    $pres_kl1 = $sheetData[$i]['39'];
        	    $pres_kl2 = $sheetData[$i]['40'];
        	    $pres_kl3 = $sheetData[$i]['41'];
        	    $check_nis = mysqli_query($db, "SELECT * FROM ".$code." WHERE nis = '$nis'");
        	    if (mysqli_num_rows($check_nis) == 0) {
        	        if (!empty($nis)) {
            	        $update = mysqli_query($db, "INSERT INTO ".$code." (nis, nama, s".$semester."_pkl1_dd, s".$semester."_pkl1_lks, s".$semester."_pkl1_bln, s".$semester."_pkl1_n, s".$semester."_pkl2_dd, s".$semester."_pkl2_lks, s".$semester."_pkl2_bln, s".$semester."_pkl2_n, s".$semester."_pkl3_dd, s".$semester."_pkl3_lks, s".$semester."_pkl3_bln, s".$semester."_pkl3_n, s".$semester."_eks1_eks, s".$semester."_eks1_n, s".$semester."_eks2_eks, s".$semester."_eks2_n, s".$semester."_eks3_eks, s".$semester."_eks3_n, s".$semester."_hdr_s, s".$semester."_hdr_i, s".$semester."_hdr_t, s".$semester."_naik, s".$semester."_pk_i, s".$semester."_pk_r, s".$semester."_pk_n, s".$semester."_pk_m, s".$semester."_pk_g, s".$semester."_pk_c, s".$semester."_pres_k1, s".$semester."_pres_k2, s".$semester."_pres_k3, s".$semester."_pres_e1, s".$semester."_pres_e2, s".$semester."_pres_e3, s".$semester."_pres_c1, s".$semester."_pres_c2, s".$semester."_pres_c3)
            	        VALUES ('$nis', '$nama', '$pkl1_dd', '$pkl1_lks', '$pkl1_bln', '$pkl1_n', '$pkl2_dd', '$pkl2_lks', '$pkl2_bln', '$pkl2_n', '$pkl3_dd', '$pkl3_lks', '$pkl3_bln', '$pkl3_n', '$eks1_eks', '$eks1_n', '$eks2_eks', '$eks2_n', '$eks3_eks', '$eks3_n', '$sakit', '$izin', '$alfa', '$kenaikan', '$integritas', '$religius', '$nasionalis', '$mandiri', '$gotongroyong', '$cpk', '$pres_k1', '$pres_k2', '$pres_k3', '$pres_ek1', '$pres_ek2', '$pres_ek3', '$pres_kl1', '$pres_kl2', '$pres_kl3')");
        	        }   
        	    } else {
        	        $update = mysqli_query($db, "UPDATE ".$code." SET s".$semester."_pkl1_dd = '$pkl1_dd', s".$semester."_pkl1_lks = '$pkl1_lks', s".$semester."_pkl1_bln = '$pkl1_bln', s".$semester."_pkl1_n = '$pkl1_n', s".$semester."_pkl2_dd = '$pkl2_dd', s".$semester."_pkl2_lks = '$pkl2_lks', s".$semester."_pkl2_bln = '$pkl2_bln', s".$semester."_pkl2_n = '$pkl2_n', s".$semester."_pkl3_dd = '$pkl3_dd', s".$semester."_pkl3_lks = '$pkl3_lks', s".$semester."_pkl3_bln = '$pkl3_bln', s".$semester."_pkl3_n = '$pkl3_n', s".$semester."_eks1_eks = '$eks1_eks', s".$semester."_eks1_n = '$eks1_n', s".$semester."_eks2_eks = '$eks2_eks', s".$semester."_eks2_n = '$eks2_n', s".$semester."_eks3_eks = '$eks3_eks', s".$semester."_eks3_n = '$eks3_n', s".$semester."_hdr_s = '$sakit', s".$semester."_hdr_i = '$izin', s".$semester."_hdr_t = '$alfa', s".$semester."_naik = '$kenaikan', s".$semester."_pk_i = '$integritas', s".$semester."_pk_r = '$religius', s".$semester."_pk_n = '$nasionalis', s".$semester."_pk_m = '$mandiri', s".$semester."_pk_g = '$gotongroyong', s".$semester."_pk_c = '$cpk', s".$semester."_pres_k1 = '$pres_k1', s".$semester."_pres_k2 = '$pres_k2', s".$semester."_pres_k3 = '$pres_k3', s".$semester."_pres_e1 = '$pres_ek1', s".$semester."_pres_e2 = '$pres_ek2', s".$semester."_pres_e3 = '$pres_ek3', s".$semester."_pres_c1 = '$pres_kl1', s".$semester."_pres_c2 = '$pres_kl2', s".$semester."_pres_c3 = '$pres_kl3' WHERE nis = '$nis'");
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
                    <div class="card-header text-uppercase">Import Rapor <? echo strtoupper($code); ?></div>
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

                            <input class="form-control" name="berkas_excel" type="file" required="required" required>
                            <br>
                            <div class="form-group float-right col-lg-6">
                                <button type="submit" name="import" class="btn btn-block btn-success">Import Nilai</button>
                            </div>

                            <div class="form-group float-left col-lg-6">
                                <a href="<?php echo $cfg_baseurl; ?>guru/siswa?1=<? echo $data_user['kelas']; ?>" class="btn btn-block btn-dark">Download Format Nilai</a>
                            </div>

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