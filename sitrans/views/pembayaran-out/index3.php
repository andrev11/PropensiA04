<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Rekapitulasi Pembayaran');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-out-index3">
 
  <div id="w0" class="grid-view">  
	<table align="center" class="table table-striped table-bordered">
        <thead align="center">
            <!-- <th> idbayar </th>-->
            <th>#</th>
            <th>Tanggal Pembayaran</th>
            <th>Customer</th>
            <!-- <th>Tanggal Pembayaran</th>-->
            <!-- <th>Status Pembayaran</th>-->
            <th>Jumlah Bayar</th>
        </thead>
        <tbody>
            <?php  $number=1;
            foreach ($rekap as $rekap): ?>
                <tr>
                    <td><?= $number++ ?></td>
                    <td><?= $rekap->tgl_bayar ?></td>
                    <td><?= $rekap->supplier ?></td>
                    <!-- <td align="center"><?= $rekap->tgl_bayar ?></td>-->
                    <!-- <td align="center"><?= $rekap->status_bayar ?></td>-->
                    <td><?= $rekap->jumlahbayar ?></td>
                    
                </tr>
            <?php endforeach; ?>
        </tbody>    
    </table>
  </div>
</div>

