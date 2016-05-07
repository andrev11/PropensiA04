
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
  SURAT JALAN
  <br>
  PT. HIJRAH GIZI HEWANI
  <br>
  <br>
</div>
<?php
  $idbayar = Yii::$app->request->get('idbayar');
  $query = "SELECT * FROM penjualan where idbayar='".$idbayar."';";
  $result = pg_query($query.";"); 
  $customer=pg_fetch_array($result);
  $namacustomer=$customer['customer'];
  echo "<br>";
  echo "KEPADA YTH : ";
  $datacustomer=pg_fetch_array(pg_query("select * from customer where namacustomer='".$namacustomer."';"));
  echo "<br>".$namacustomer; 
  echo " - (".$datacustomer['telponcustomer'].")"; 
  echo "<br>".$datacustomer['alamatcustomer'];
  echo "<br>";
  
?>

<br>

<table align="center" class="tg">
  <tr align="center">
    <th class="tg-9hbo">No.</th>
    <th class="tg-9hbo">Produk</th>
    <th class="tg-9hbo">Jumlah Kilo</th>
    <th class="tg-9hbo">Jumlah Karton</th>
    <th class="tg-9hbo">Harga Total</th>
  </tr>
<?php 
  $idbayar = Yii::$app->request->get('idbayar');
  $query = "SELECT * FROM penjualan where idbayar='".$idbayar."';";
  $result = pg_query($query.";"); 
  	$i = 1;
    $totalharga=0;
    $totalkilo=0;
  	while($row = pg_fetch_assoc($result)) { 
      $totalharga += $row['harga_total'];
      $totalkilo +=$row['kilo'];
    ?>
    <tr>
      <td align="center" class="tg-lqy6"><?php echo $i++; ?></td>
      <td align="center" class="tg-yw4l"><?php echo $row['produk'];?></td>
      <td align="center" class="tg-yw4l"><?php echo $row['kilo'];?></td>
      <td align="center" class="tg-yw4l"><?php echo $row['karton'];?></td>
      <td align="center" class="tg-yw4l"><?php echo 'Rp. '.$row['harga_total'];?></td>
    </tr>
  <?php } ?>
    <tr> 
      <td align="center" class="tg-yw4l"><?php echo "Total Bayar Rp. ".$totalharga?></td> 
      <td align="center" class="tg-yw4l"><?php echo "Total Kilo ".$totalkilo?></td>
    </tr>
</table>