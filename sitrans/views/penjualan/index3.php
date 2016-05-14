<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\base\Model; 
use app\models\Penjualan;
use yii\db\Query;
use app\controllers\SiteController;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PembelianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Rekapitulasi Penjualan');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembelian-index3">

    
    <?php $month = $year = "" ?>
    <form method="POST">
    <p>
        <label for="month"> Bulan </label>
        <input class ="input" name="month" type="text" id="txtList"  
                placeholder="Masukkan Bulan" list="month" 
                required autofocus >
                <datalist id="month">
                    <option value="Januari">
                    <option value="Februari">
                    <option value="Maret">
                    <option value="April">
                    <option value="Mei">
                    <option value="Juni">
                    <option value="Juli">
                    <option value="Agustus">
                    <option value="September">
                    <option value="Oktober">
                    <option value="November">
                    <option value="Desember">
                </datalist>
        
        <label for="year"> Tahun </label>
        <input list="year" name="year" placeholder="Masukkan Tahun">
            <datalist id="year">
                <?php 
                  $right_now = getdate();
                  $this_year = $right_now['year'];
                  $start_year = 2000;
                  while ($start_year <= $this_year) {
                      echo "<option>{$this_year}</option>";
                      $this_year--;
                  }
                 ?>
            </datalist>
        </input>        
        <input id="submit" type="submit" value="Submit">

    </p>
    </form>
        <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                echo SiteController::connect(); 
                $bulan = $_POST["month"];
                $tahun = $_POST["year"];
                $month=$bulan;

                if($bulan == 'Januari') {
                    $bulan = 1;
                } else if($bulan == 'Februari') {
                    $bulan = 2;
                }else if($bulan == 'Maret') {
                    $bulan = 3;
                }else if($bulan == 'April') {
                    $bulan =4 ;
                } else if($bulan == 'Mei') {
                    $bulan =5 ;
                } else if($bulan == 'Juni') {
                    $bulan =6 ;
                } else if($bulan == 'Juli') {
                    $bulan =7 ;
                } else if($bulan == 'Agustus') {
                    $bulan =8 ;
                } else if($bulan == 'September') {
                    $bulan =9 ;
                } else if($bulan == 'Oktober') {
                    $bulan =10 ;
                } else if($bulan == 'November') {
                    $bulan =11 ;
                } else if($bulan == 'Desember') {
                    $bulan = 12 ;
                }
                $query = "SELECT produk, sum(kilo) FROM Penjualan WHERE EXTRACT(month FROM tgl_jual) = '".$bulan."' AND EXTRACT(year FROM tgl_jual) = '".$tahun."' GROUP BY produk, EXTRACT(month FROM tgl_jual), EXTRACT(year FROM tgl_jual);";

                $result = pg_query($query);


                if (pg_num_rows($result)!=0){
                    echo "<br>"; 
                    echo "<h3>Rekapitulasi Penjualan Bulan ".$month." ".$tahun." </h3> <br>"; 

                    echo "<table class='table table-striped table-bordered'>"; 
                    echo "<thead>";
                    echo "<th>#</th>";
                    echo "<th>Produk</th>";
                    echo "<th>Jumlah Penjualan (kg)</th>";
                    echo "</thead>";
                    echo "<tbody>"; 
                       
                        $count=0;
                        while($value = pg_fetch_array($result)){
                            $count++;
                            echo "<td align='left'>".$count."</td>";
                            echo "<td align='left'>".$value['produk']."</td>";
                            echo "<td align='left'>".$value['sum']."</td>";
                            echo "</tr>";
                        }
                    echo "</tbody>";  
                    echo "</table>";

                } else {
                     echo "<h3>Rekapitulasi Penjualan ".$month." ".$tahun." tidak ditemukan</h3> <br>";
                }
            }
        ?>
</div>
