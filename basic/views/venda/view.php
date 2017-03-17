<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Venda */

$this->title = $model->idcompra;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vendas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venda-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <p>
        <?php Modal::begin([

            'header' => '<h2>Atualize o Valor</h2>',
            'toggleButton' => ['class' => 'btn btn-primary', 'label' => "<i class='fa fa-comments-o'> Atualizar </i>"]

        ]);
        ?>

        <?php $form = ActiveForm::begin(['method' => 'post', 'action' => Url::to('index.php?r=venda/update')]); ?>

        <?= $form->field($model, 'valor')->textInput() ?>
        <input name="id" type="hidden" value= <?= $model->idcompra ?>>
        <input name="nome" type="hidden" value=<?= $nome ?>>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Atualizar'), ['class' => 'btn btn-primary']) ?>
    </div>

        <?php ActiveForm::end(); ?>

        <?php

           Modal::end();


        ?>


        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idcompra], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'valor',
            'data_venda',

        ],
    ]) ?>

</div>
