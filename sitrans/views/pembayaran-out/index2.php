<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Hutang');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-out-index2">

    
  <div id="w0" class="grid-view">  
	<table align="center" class="table table-striped table-bordered">
        <thead align="center">
            <!-- <th> idbayar </th>-->
            <th>#</th>
            <th>Supplier</th>
            <th>Tanggal Pembelian</th>
            <!-- <th>Tanggal Pembayaran</th>-->
            <!-- <th>Status Pembayaran</th>-->
            <th>Jumlah Hutang</th>
        </thead>
        <tbody>
            <?php  $number=1;
            foreach ($hutang as $hutang): ?>
                <tr>
                    <td><?= $number++ ?></td>
                    <td><?= $hutang->supplier ?></td>
                    <td><?= $hutang->tgl_trans ?></td>
                    <td><?= $hutang->jumlahbayar ?></td>
                    
                    <td><?= Html::a('Confirm', ['confirm', 'id' => $hutang->idbayar], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to confirm this item?',
                            'method' => 'post',
                        ],
                    ]) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>    
    </table>
  </div>
</div>
