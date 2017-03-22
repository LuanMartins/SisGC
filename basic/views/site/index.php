<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use app\models\Cliente;
use yii\helpers\ArrayHelper;
use app\models\Venda;

$url = \yii\helpers\Url::to(['cliente-list']);


$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        


        <?php if(isset($model)){ ?>


            <h1>Olá Seja bem vindo ao SisGC <strong><?=Yii::$app->user->identity->username?></strong></h1>

        <?php }else {?>

            <h1> Olá Seja bem vindo ao SisGC </h1>

        <?php } ?>


        <br/>
        <br/>
        <br/>

    </div>

    <div id="botoes">
        <?php if (isset($model)) { ?>

            <?php \yii\bootstrap\Modal::begin([

                'options' => [
                    'id' => 'kartik-modal',
                    'tabindex' => false // important for Select2 to work properly
                ],

                'header' => '<h2>Cadastrar Venda</h2>',
                'toggleButton' => ['class' => 'btn  btn-warning', 'label' => "<i class='fa fa-2x fa-dollar'> Realizar Venda </i>"]
            ]);

            ?>
            <?php $form = ActiveForm::begin(['method' => 'post', 'action' => Url::to('index.php?r=venda/create')]); ?>

            


            <?= $form->field($model,'comprador_idcomprador')->widget(Select2::className(),[
                'data' => ArrayHelper::map(Cliente::find()->limit(5)->all(),'idcomprador','nome'),
                'options' => ['placeholder' => 'Selecione o Cliente ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],

            ]);
            ?>
            <br/>
            <?= $form->field($model, 'valor') ?>




            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Realizar Venda'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>

            <?php \yii\bootstrap\Modal::end();

        }?>


        <?php if (isset($modelCliente)) { ?>

            <?php \yii\bootstrap\Modal::begin([
                'header' => '<h2>Cadastro de Cliente</h2>',
                'toggleButton' => ['class' => 'btn btn-danger', 'label' => "<i class='fa fa-2x fa-user'> Cadastrar Cliente </i>"]
            ]);

            ?>
            <?php $form = ActiveForm::begin(['id'=> $model->formName(),'method' => 'post', 'action' => 'index.php?r=cliente%2Fcreate']); ?>

            <?= $form->field($modelCliente, 'nome')->textInput(['maxlength' => true]) ?>

            <?= $form->field($modelCliente, 'apelido')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Realizar Cadastro'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>

            <?php \yii\bootstrap\Modal::end();

        }?>




        <?php

        if(isset($dataProvider)){
            \yii\bootstrap\Modal::begin([

                'header' => '<h2>Historico</h2>',
                'toggleButton' => ['class' => 'btn btn-success', 'label' => "<div style='height: 10px'><i class='fa fa-2x fa-archive'> Historico de Vendas</i></div>"]

            ]) ?>

            <?php \yii\widgets\Pjax::begin(); ?>
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'nome_vendedor',
                    'nome_cliente',
                    'data',
                    'valor',


                    ['class' => 'yii\grid\ActionColumn',

                        'template' => '{registro}',
                        'buttons' =>[
                            'registro' => function ($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-download">',["site/pdf",'dados' => $model->data]);
                            }

                        ],



                    ],
                ],
            ]); ?>
            <?php \yii\widgets\Pjax::end(); ?>

            <?php \yii\bootstrap\Modal::end();


        }?>


    </div>
    <div class="body-content">

<?php if (Yii::$app->session->hasFlash('contactFormSubmitted')){ ?>

    <div class="alert bg-success" role="alert">
        <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg>
        Cliente Cadastrado Com sucesso !!!
        </div>


<?php }?>


        <?php if (Yii::$app->session->hasFlash('vendaEfetuada')){ ?>

            <div class="alert bg-success" role="alert">
                <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg>
                Venda Efetuada Com Sucesso !!!
            </div>


        <?php }?>




    </div>
</div>





