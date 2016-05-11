<?php
  use app\controllers\SiteController; 
  echo SiteController::connect();
?>

<style type="text/css">


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
	
	th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
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

<br>

<div class="enjoy-css">
  FAKTUR PENJUALAN
  <br>
  <br>
</div>

<div class="cihuy-css">
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
</div>

<br>

<table align="center" class="tg">
	<tr align="center">
		<th >No.</th>
		<th width="200px">Nama Produk</th>
		<th width="100px">KG</th>
		<th width="100px">Karton</th>
		<th width="150px">Harga Satuan</th>
		<th width="100px">Jumlah</th>
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
		   $totalkarton += $row['karton'];
		   $harga_satuan = $totalharga/$totalkilo;
	?>
    <tr>
      <td><?php echo $i++; ?></td>
      <td><?php echo $row['produk'];?></td>
      <td><?php echo $row['kilo'];?></td>
      <td><?php echo $row['karton'];?></td>
	  <td><?php echo 'Rp. '.$harga_satuan;?></td>
      <td><?php echo 'Rp. '.$row['harga_total'];?></td>
    </tr>

	<tr>
		<td></td>
		<td><?php echo "Total"?></td>
		<td><?php echo $totalkilo?></td>
		<td><?php echo $totalkarton?></td>
		<td></td>
		<td><?php echo "Rp. ".$totalharga?></td>
	</tr>
    <?php } ?>

</table>

<div class="cihuy-css">
	<br>

	<table align="center">
		<tr>

			<td>
				<br>
				Penerima,
				<br>
				<br>
				<br>
				<br>
				<br>
				(Nama Lengkap)
			</td>
			<td  width="312px">
			</td>
			<td>
				
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				(Danur)
			</td>
			<td align="left">
				Bekasi, 
				<?php
				  echo date("d F Y");
				?>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				(Sularjo)
			</td>
		</tr>
	</table>
</div>