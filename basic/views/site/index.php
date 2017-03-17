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

     <div id="botoes">
        <?php if (isset($model)) { ?>

            <?php \yii\bootstrap\Modal::begin([

                'options' => [
                    'id' => 'kartik-modal',
                    'tabindex' => false // important for Select2 to work properly
                ],

                'header' => '<h2>Envie Sua Mensagem</h2>',
                'toggleButton' => ['class' => 'btn btn-md btn-primary', 'label' => "<i class='fa fa-comments-o'> Realizar Venda </i>"]
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
                'toggleButton' => ['class' => 'btn btn-md btn-danger', 'label' => "<i class='fa fa-comments-o'> Cadastra Cliente </i>"]
            ]);

            ?>
            <?php $form = ActiveForm::begin(['id'=> $model->formName(),'method' => 'post', 'action' => 'index.php?r=cliente%2Fcreate']); ?>

            <?= $form->field($modelCliente, 'nome')->textInput(['maxlength' => true]) ?>

            <?= $form->field($modelCliente, 'apelido')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Realizar Venda'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>

            <?php \yii\bootstrap\Modal::end();

        }?>





     </div>
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


        <div class="row">
            <div class="col-md-12">

                <legend class="text-info">
                    <div id="texto">
                    <small><strong><center>Pesquise Pelo Cliente</center></strong></small>
                        </div>
                    </legend>

                <?php $form = ActiveForm::begin(['method' => 'get', 'action' => 'index.php?r=site/pesquisa']); ?>


                <div class="input-group">
                    <?= Html::textInput('nome',null,['class' =>'form-control','placeholder' => 'Digite o Nome ou Apelido']) ?>

                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>

                </div>

            </div>


  


    </div>
</div>


