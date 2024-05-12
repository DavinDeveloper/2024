<?
include '../../lib/config.php';

	$check_pembelian = mysqli_query($db, "SELECT * FROM pembelian WHERE id = '".$_GET['1']."'");
	$data_pembelian = mysqli_fetch_assoc($check_pembelian);
	$data_pembeli = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE username = '".$data_pembelian['username']."'"));

	if (mysqli_num_rows($check_pembelian) == 0) {
		header("Location: ".cfg(url)."dashboard");
	} else if (empty($_GET['1'])) {
        header("Location: " . cfg(url)."dashboard");
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><? echo $data_pembelian['username']; ?> - <? echo $data_pembelian['produk']; ?></title>
    <meta name="description" content="Invoice Pembelian Paket Haji">
    <style>
        body {
            font-family: Verdana;
            font-size: 13px;
        }

        style.page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
<a id="print">
    <table width="100%" cellpadding="0">
        <tr colspan="11">
            <td style="padding-left: 30px"><img src="<? echo cfg(logo); ?>" alt="logo" width="90px"></td>
            <th colspan="10" style="padding-right: 95px" width="80%">
                <font size="5,5"><br><? echo cfg(nama); ?></br></font size>
                <font size="2px" ;> <? echo cfg(address); ?></font><br>
                <font size="1" ;>Telp.(<? echo cfg(phone); ?>), Email : <? echo cfg(email); ?></font>
            </th>
        <tr>

            <td colspan="11">
                <hr></td>
        </tr>

        <tr>
            <th colspan="11"><br><br>FORMULIR PEMBAYARAN<br><br><br></th>
        </tr>
    </table>

    <table width="100%" cellpadding="0">
        <tr>
            <td style="width: 18%">Nama</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><? echo $data_pembeli['nama']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Paket</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><? echo $data_pembelian['produk']; ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Harga</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%">Rp<? echo number_format($data_pembelian['harga'],0,',','.'); ?></td>
        </tr>
        <tr>
            <td style="width: 18%">Status</td>
            <td style="width: 1%">:</td>
            <td style="width: 33%"><? echo $data_pembelian['status']; ?></td>
        </tr>
    </table>
    <br><br>
                <table>
                    <p></p>
                    <p></p>
                    <tr>
                        <table width="100%"> 
                            <tr>
                                <td style="width: 20%">Dicetak pada : <? echo date("Y-m-d H:i:s"); ?>
                                <br><br><br><br><br><br>
                                <br><br><br><br><br><br><br><br><br><br></td>
                                <td style="width: 15%"></td>
                                <td style="width: 15%">Penandatangan,<br><br><br><br><br><br><br><b><? echo $data_pembeli['nama']; ?></td>
                            </tr>


                        </table>
                        </center>
</a>
<script>
    document.getElementById("print").addEventListener("click", function() {
        window.print();
    });
</script>
</body>
</html>
