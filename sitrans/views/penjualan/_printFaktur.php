
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

  .cihuy-css {
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box;
    border: none;
    font: normal normal 16px/2 Verdana, Geneva, sans-serif;
    color: black;
    -o-text-overflow: ellipsis;
    text-overflow: ellipsis;
    letter-spacing: 1px;
    word-spacing: 1px;
  }

</style>
<div class="cihuy-css">
  PT. HIJRAH GIZI HEWANI
  <br>
  Jl. Raya Bantar Gebang Setu No. 57 Bekasi
  <br>
  Telp. : 08-221-000-248
  <br>
</div>

<div class="enjoy-css">
  FAKTUR PENJUALAN
  <br>
</div>
<div class="cihuy-css">
  Kepada Yth.
  <br>
  <?php
    $idbayar = Yii::$app->request->get('idbayar');
    $query = "SELECT * FROM penjualan where idbayar='".$idbayar."';";
    $result = pg_query($query.";"); 
    $customer=pg_fetch_array($result);
    echo $customer['customer'];
  ?>
  <br>
  <?php
    $idbayar = Yii::$app->request->get('idbayar');
    $query = "SELECT distinct alamatcustomer FROM penjualan, customer where idbayar='".$idbayar."' and customer=namacustomer";
    $result = pg_query($query.";"); 
    $alamatCustomer=pg_fetch_array($result);
    echo $alamatCustomer['alamatcustomer'];
  ?>
</div>
<table align="center" class="tg">
  <tr align="center">
    <th class="tg-9hbo">No.</th>
    <th class="tg-9hbo">Produk</th>
    <th class="tg-9hbo">Kilo</th>
    <th class="tg-9hbo">Karton</th>
    <th class="tg-9hbo">Harga</th>
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
      <td align="center" class="tg-yw4l"><4?php echo "Jumlah Bayar Rp. ".$totalharga?></td> 
      <td align="center" class="tg-yw4l"><?php echo "Jumlah Kilo ".$totalkilo?></td> 
    </tr>
</table>
<div class="cihuy-css">
  Bekasi, 
  <?php
  echo date("d F Y");
?>
</div>