<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use app\controllers\SiteController;
use miloschuman\highcharts\Highcharts;

$this->title = 'Dashboard';
?>
<div class="site-index">

    <div class="jumbotron">
        
		<h1>Welcome, 
		
		<?php
                          if(isset(Yii::$app->user->identity->username))
                              $info[] = (\Yii::$app->user->identity->nama);

                          echo implode($info);

        ?>!</h1>
		
        <?php
			if(Yii::$app->user->identity->role=='bod'){
			 	
			 	date_default_timezone_set('Asia/Jakarta');
				echo SiteController::connect();

				$result = pg_query("select date_trunc('month', pembayaran_in.tgl_bayar), sum(pembayaran_in.jumlahbayar) 
					as pembayaran_in, sum(pembayaran_out.jumlahbayar) as pembayaran_out from pembayaran_in FULL OUTER JOIN 
					pembayaran_out ON date_trunc('month', pembayaran_in.tgl_bayar) = date_trunc('month', pembayaran_out.tgl_bayar)
					WHERE date_trunc('month', pembayaran_in.tgl_bayar) BETWEEN date_trunc('month', current_timestamp - interval '1 year') 
					AND date_trunc('month', current_timestamp) GROUP BY 1 ORDER BY 1;");

				$kategori = array();
				$pembayaran_in = array();
				$pembayaran_out = array();
				while($row = pg_fetch_assoc($result)) {
					array_push($kategori, date("F Y", strtotime($row['date_trunc'])));
					array_push($pembayaran_in, (int)$row['pembayaran_in']/2);
					array_push($pembayaran_out, (int)$row['pembayaran_out']/2);
				}
				 

				echo Highcharts::widget([
					'options'=>[
						'title' => ['text' => 'Data Pendapatan dan Pengeluaran PT. HIJRAH GIZI HEWANI'],
						'xAxis' => ['categories' => $kategori],
						'yAxis' => ['title' => ['text' => 'Dalam Juta Rupiah']],
						'series' => [
										['name' => 'Pendapatan', 'data' => $pembayaran_in, 'color' => '#0000FF'],
										['name' => 'Pengeluaran', 'data' => $pembayaran_out, 'color' => '#000000']
									]
					]
				]);
			}
		?>
		
		<?php 
        	if(Yii::$app->user->identity->role=='purchasing'){
        		echo "<br>"; 
        		echo "<h3>Daftar Re-Order</h3> <br>"; 
        		echo "<table class='table table-striped table-bordered'>"; 
		        echo "<thead>";
		         echo "<th>#</th>";
		        echo "<th>Nama Jenis</th>";
		        echo "<th>Stok Kilo</th>";
		        echo "<th>Stok Karton</th>";
		        echo "<th>ROP</th>";
		        echo "</thead>";
				echo "<tbody>"; 
					echo SiteController::connect();
	 				$query=pg_query("Select * from jenis where stok_kilo < rop;");
	 				$count=0;
		        	while($value = pg_fetch_array($query)){
		        		$count++;
		        		echo "<td align='left'>".$count."</td>";
						echo "<td align='left'>".$value['namajenis']."</td>";
						echo "<td align='left'>".$value['stok_kilo']."</td>";
						echo "<td align='left'>".$value['stok_karton']."</td>";
						echo "<td align='left'>".$value['rop']."</td>";
						echo "</tr>";
					}
				echo "</tbody>";  
		    	echo "</table>";
			} 
		?> 
              
 	</div>
</div>