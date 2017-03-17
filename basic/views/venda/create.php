<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Venda */

$this->title = Yii::t('app', 'Create Venda');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vendas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venda-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
