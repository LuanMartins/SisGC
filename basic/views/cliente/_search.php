<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClienteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idcomprador') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'apelido') ?>

    <?= $form->field($model, 'cpf') ?>

    <?= $form->field($model, 'telefone') ?>

    <?php // echo $form->field($model, 'rua') ?>

    <?php // echo $form->field($model, 'bairro') ?>

    <?php // echo $form->field($model, 'numero_casa') ?>

    <?php // echo $form->field($model, 'limite_credito') ?>

    <?php // echo $form->field($model, 'cep') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
