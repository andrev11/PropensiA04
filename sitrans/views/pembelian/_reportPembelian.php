
<?php
use app\controllers\SiteController; 
echo SiteController::connect();
?>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-lqy6{text-align:right;vertical-align:top}
.tg .tg-9hbo{font-weight:bold;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}

.enjoy-css {
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  border: none;
  font: normal normal bold 16px/2 Verdana, Geneva, sans-serif;
  color: black;
  text-align: center;
  -o-text-overflow: ellipsis;
  text-overflow: ellipsis;
  letter-spacing: 1px;
  word-spacing: 1px;
}
</style>

<div class="enjoy-css">
LAPORAN PEMBELIAN
<br>
PT. HIJRAH GIZI HEWANI
<br>
Per Tanggal 
<?php
echo date("d F Y");
?>
<br>

</div>

<br>

<table align="center" class="tg">
  <tr align="center">
    <th class="tg-9hbo">No.</th>
    <th class="tg-9hbo">Produk</th>
    <th class="tg-9hbo">Tanggal Beli</th>
    <th class="tg-9hbo">Tanggal Terima</th>
    <th class="tg-9hbo">Cara Terima</th>
    <th class="tg-9hbo">Cara Bayar</th>
    <th class="tg-9hbo">Status Delivery</th>
    <th class="tg-9hbo">Harga Total</th>
    <th class="tg-9hbo">Jumlah Karton</th>
    <th class="tg-9hbo">Jumlah Kilo</th>
  </tr>
<?php 
$tgl_beli = Yii::$app->request->get('tgl_beli');
$query = "SELECT * FROM pembelian ORDER BY tgl_beli DESC ";
if(null !== $tgl_beli){ 
	$query = $query."WHERE tgl_beli = '".$tgl_beli."'";
}
$result = pg_query($query.";"); 
	$i = 1;
	while($row = pg_fetch_assoc($result)) { ?>
  <tr>
    <td align="center" class="tg-lqy6"><?php echo $i++; ?></td>
    <td class="tg-yw4l"><?php echo $row['produk'];?></td>
    <td align="center" class="tg-yw4l"><?php echo $row['tgl_beli'];?></td>
    <td align="center" class="tg-yw4l"><?php echo $row['tgl_terima'];?></td>
    <td align="center" class="tg-yw4l"><?php echo $row['cara_terima'];?></td>
    <td align="center" class="tg-yw4l"><?php echo $row['cara_bayar'];?></td>
    <td align="center" class="tg-yw4l"><?php echo $row['status_del'];?></td>
    <td align="center" class="tg-yw4l"><?php echo 'Rp. '.$row['harga_total'];?></td>
    <td align="center" class="tg-yw4l"><?php echo $row['karton'];?></td>
    <td align="center" class="tg-yw4l"><?php echo $row['kilo'];?></td>
  </tr>

  <?php } ?>
</table>