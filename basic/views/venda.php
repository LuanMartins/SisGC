<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Venda */
/* @var $form ActiveForm */
?>
<div class="venda">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'valor') ?>
        <?= $form->field($model, 'data_venda') ?>
        <?= $form->field($model, 'comprador_idcomprador') ?>
        <?= $form->field($model, 'user_id') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- venda -->
