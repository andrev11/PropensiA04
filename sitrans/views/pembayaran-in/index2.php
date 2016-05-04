<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Piutang');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-in-index2">

    
  <div id="w0" class="grid-view">  
	<table align="center" class="table table-striped table-bordered">
        <thead align="center">
            <!-- <th> idbayar </th>-->
            <th>#</th>
            <th>Customer</th>
            <th>Tanggal Penjualann</th>
            <th>Jumlah Piutang</th>
        </thead>
        <tbody>
            <?php  $number=1;
            foreach ($piutang as $model): ?>
                <tr>
                    <td><?= $number++ ?></td>
                    <td><?= $model->customer ?></td>
                    <td><?= $model->tgl_trans ?></td>
                    <td><?= $model->jumlahbayar ?></td>
                    
                    <td><?= Html::a('Confirm', ['confirm', 'id' => $model->idbayar], [
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
