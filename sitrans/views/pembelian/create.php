<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pembelian */

$this->title = Yii::t('app', 'Create Pembelian');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pembelian'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembelian-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
