<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Historico */

$this->title = Yii::t('app', 'Create Historico');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Historicos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historico-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
