<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Cliente',
]) . $model->idcomprador;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcomprador, 'url' => ['view', 'id' => $model->idcomprador]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cliente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
