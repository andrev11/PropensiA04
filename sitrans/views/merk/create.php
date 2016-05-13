<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Merk */

$this->title = Yii::t('app', 'Tambah Merk');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Merk'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merk-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
