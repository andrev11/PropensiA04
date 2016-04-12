<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use app\themes\adminLTE\components\ThemeNav;

?>
<?php $this->beginContent('@app/themes/adminLTE/layouts/main.php'); ?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

     <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/user_accounts.png" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>
                      <?php
                          $info[] = Yii::t('app','Hello');

                          if(isset(Yii::$app->user->identity->username))
                              $info[] = (\Yii::$app->user->identity->username);

                          echo implode(', ', $info);
                      ?>
                    </p>
                    <a><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <?php
                echo Menu::widget([
                  'encodeLabels'=>false,
                  'options' => [
                    'class' => 'sidebar-menu'
                  ],
                  'items' => [
                      ['label'=>Yii::t('app','MAIN NAVIGITION'), 'options'=>['class'=>'header']],
                      ['label' => ThemeNav::link('Dashboard', 'fa fa-dashboard'), 'url' => ['site/index'], 'visible'=>!Yii::$app->user->isGuest],
					  ['label' => ThemeNav::link('Pengguna', 'fa fa-book'), 'url' => ['pengguna/index'], 'visible'=>!Yii::$app->user->isGuest],
					  ['label' => ThemeNav::link('Customer', 'fa fa-edit'), 'url' => ['customer/index'], 'visible'=>!Yii::$app->user->isGuest],
					  ['label' => ThemeNav::link('Supplier', 'fa fa-table'), 'url' => ['supplier/index'], 'visible'=>!Yii::$app->user->isGuest],
					  ['label' => ThemeNav::link('Merk', 'fa fa-table'), 'url' => ['merk/index'], 'visible'=>!Yii::$app->user->isGuest],
					  ['label' => ThemeNav::link('Jenis', 'fa fa-table'), 'url' => ['jenis/index'], 'visible'=>!Yii::$app->user->isGuest],
					  ['label' => ThemeNav::link('Produk', 'fa fa-table'), 'url' => ['produk/index'], 'visible'=>!Yii::$app->user->isGuest],
					  ['label' => ThemeNav::link('Pembelian', 'fa fa-table'), 'url' => ['pembelian/index'], 'visible'=>!Yii::$app->user->isGuest],
					  ['label' => ThemeNav::link('Penjualan', 'fa fa-table'), 'url' => ['penjualan/index'], 'visible'=>!Yii::$app->user->isGuest],
                  ],
                ]);
            ?>

        </section>
  <!-- /.sidebar -->
</aside>

<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">

   <!-- Content Header (Page header) -->
   <section class="content-header">
        <h1> <?php echo Html::encode($this->title); ?> </h1>
           <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php echo $content; ?>
    </section><!-- /.content -->

</div><!-- /.right-side -->
<?php $this->endContent();