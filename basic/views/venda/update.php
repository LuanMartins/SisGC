<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Venda */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Venda',
]) . $model->idcompra;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vendas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcompra, 'url' => ['view', 'id' => $model->idcompra]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="venda-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        
    ]) ?>

</div>
