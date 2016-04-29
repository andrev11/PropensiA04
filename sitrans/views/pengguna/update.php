<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pengguna */

$this->title = 'Update Pengguna: ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Pengguna'];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->username]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengguna-update">

    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role != 'admin'){
	echo $this->render('_form2', [
        'model' => $model,
    ]) ;
	} else if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'admin' && Yii::$app->getRequest()->getQueryParam('id') == Yii::$app->user->identity->username) {
	echo $this->render('_form2', [
        'model' => $model,
    ]) ;
	} else if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'admin') {
	echo $this->render('_form3', [
        'model' => $model,
    ]) ;
	}
	?>

</div>
