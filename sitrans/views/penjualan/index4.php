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

$this->title = Yii::t('app', 'Daftar Untuk Pengiriman');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penjualan-index4">    
   
        <?php 
                echo SiteController::connect();
                $query="";
                //surat jalan AI, faktur Finance
                if(Yii::$app->user->identity->role == 'admin inventori'){
                    $query = "SELECT customer, tgl_jual, idbayar FROM Penjualan WHERE status_del='Belum Dikirim' and cara_kirim= 'Delivery'
                    GROUP BY customer, tgl_jual, idbayar;";
                } else if (Yii::$app->user->identity->role == 'finance'){
                    $query = "SELECT customer, tgl_jual, idbayar FROM Penjualan WHERE status_del='Belum Dikirim' 
                    GROUP BY customer, tgl_jual, idbayar;";
                }
                $result = pg_query($query);                 
                echo "<table class='table table-striped table-bordered'>"; 
                echo "<thead>";
                echo "<th>#</th>";
                echo "<th>Customer</th>";
                echo "<th>Tanggal Transaksi</th>";
                echo "</thead>";
                echo "<tbody>"; 
                   
                    $count=0;
                    while($value = pg_fetch_array($result)){
                        $count++;
                        $idbayar=$value['idbayar'];
                        echo "<td align='left'>".$count."</td>";
                        echo "<td align='left'>".$value['customer']."</td>";
                        echo "<td align='left'>".$value['tgl_jual']."</td>";
                        echo "<td align='left'>";
                        echo  Html::a(Yii::t('app', 'Print'), ['print', 'idbayar' => $idbayar ], ['class' => 'btn btn-success']);
                        echo "</td>";
                        echo "</tr>";
                    }
                echo "</tbody>";  
                echo "</table>";
        ?>
</div>