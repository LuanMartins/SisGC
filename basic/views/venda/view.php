<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Venda */

$this->title = $model->compradorIdcomprador->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vendas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venda-view">

    <h1><?= Html::encode($this->title) ?></h1>




    <p>
        <div class="input-group">
        <?php Modal::begin([

            'header' => '<h2>Atualize o Valor</h2>',
            'toggleButton' => ['class' => 'btn btn-primary', 'label' => "Atualizar"]

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


        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idcompra, 'valor' => $model->valor], [
            'class' => 'btn btn-secundary',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>

        </div>
        </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'valor',
            'data_venda',

        ],
    ]) ?>

</div>

<?php




$script = <<< JS


 
      $(document).ready(function() {

          
          // tentando setar mascara de valor para o campo de id = venda_valor
          // $("#venda-valor").mask('000.000.000.000.000,00');
           
           
            
         
            
            $("#venda-valor").mask('000.000.000.000.000.00',{reverse:true});
            
            
            
            //Quando o campo cep perde o foco.
           
        });


JS;

$this->registerJs($script);





?>
