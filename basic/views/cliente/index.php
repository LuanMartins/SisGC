<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Clientes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idcomprador',
            'nome',
            //'apelido',
            'cpf',
            'telefone',
            // 'rua',
            // 'bairro',
            // 'numero_casa',
             'limite_credito',
            // 'cep',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>




    <?php if (Yii::$app->session->getFlash("alterarCliente")){ ?>

        <div class="alert bg-success text-center" role="alert">
            <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg>
            Informação de Cliente Alterada Com Sucesso !!!
        </div>

    <?php }?>



</div>
