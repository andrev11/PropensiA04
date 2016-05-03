<?php

/* @var $this yii\web\View */

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
         use miloschuman\highcharts\Highcharts;
         use app\controllers\SiteController; 
         echo SiteController::connect();

         $result = pg_query("select date_trunc('month', pembayaran_in.tgl_bayar), sum(pembayaran_in.jumlahbayar) as pembayaran_in, sum(pembayaran_out.jumlahbayar) as pembayaran_out from pembayaran_in FULL OUTER JOIN pembayaran_out ON date_trunc('month', pembayaran_in.tgl_bayar) = date_trunc('month', pembayaran_out.tgl_bayar) WHERE date_trunc('month', pembayaran_in.tgl_bayar) BETWEEN date_trunc('month', current_timestamp - interval '1 year') AND date_trunc('month', current_timestamp) GROUP BY 1 ORDER BY 1;");

         $kategori = array();
         $pembayaran_in = array();
         $pembayaran_out = array();
         while($row = pg_fetch_assoc($result)) {
         	array_push($kategori, date("F Y", strtotime($row['date_trunc'])));
         	array_push($pembayaran_in, (int)$row['pembayaran_in']);
         	array_push($pembayaran_out, (int)$row['pembayaran_out']);
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
			?>

    </div>
</div>
