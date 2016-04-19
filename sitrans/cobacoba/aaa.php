<?php $model = new Pembelian(); ?>
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>

            <?= $form->field($model, $start_date)->textInput(['type' => 'date'])->label('Start date') ?>
            <?= $form->field($model, $end_date)->textInput(['type' => 'date'])->label('End date'); ?>

           
            <?php ActiveForm::end(); ?>
    
