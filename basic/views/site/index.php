<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
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


                'size' => \yii\bootstrap\Modal::SIZE_DEFAULT,
                'header' => '<h2>Cadastro de Cliente</h2>',
                'toggleButton' => ['class' => 'btn btn-danger', 'label' => "<i class='fa fa-2x fa-user'> Cadastrar Cliente </i>"]
            ]);



            ?>
            <?php $form = ActiveForm::begin(['id'=> $model->formName(),'method' => 'post', 'action' => 'index.php?r=cliente%2Fcreate']); ?>




            <?php echo Form::widget([
            'model'=>$modelCliente,
            'form'=>$form,
                'contentBefore' => '<legend class="text-info"><small>Dados Pessoais</small></legend>',
            'columns'=>3,
            'attributes'=>[       // 2 column layout
            'nome'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nome do Cliente','maxlength' => true]],
            'apelido'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder' => 'Apelido do Cliente (opcional)','maxlength' => true]],
            'cpf' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => \yii\widgets\MaskedInput::className(), 'options'=>[


                'mask' => '99.999.999-99',
                ],
            ]
            ]
            ]);

            ?>


            <?php echo Form::widget([
                'model'=>$modelCliente,
                'form'=>$form,
                'columns'=>2,
                'attributes'=>[       // 2 column layout

                    'telefone' => ['type' => Form::INPUT_WIDGET,'widgetClass' => \yii\widgets\MaskedInput::className(),'options' =>[

                        'mask' => '(999)9-9999-9999',
                    ]],

                    'limite_credito' => ['type' => Form::INPUT_TEXT, 'options'=>['placeholder' => 'Telefone do Cliente','maxlength' => true]],

                ]
            ]);

            ?>


            <?php echo Form::widget([
                'model'=>$modelCliente,
                'form'=>$form,
                'contentBefore' => '<legend class="text-info"><small>Endereço</small></legend>',
                'columns'=>2,
                'attributes'=>[       // 2 column layout

                    'cep' => ['id' => 'cep', 'type' => Form::INPUT_WIDGET, 'widgetClass' => \yii\widgets\MaskedInput::className(), 'options'=>[

                        'mask' => '99999-999',

                    ]],
                    'rua' => ['id' => 'rua','type' => Form::INPUT_TEXT, 'options'=>['maxlength' => true]],


                ]
            ]);

            ?>

            <?php echo Form::widget([
                'model'=>$modelCliente,
                'form'=>$form,
                'columns'=>2,
                'attributes'=>[       // 2 column layout

                    'bairro' => ['id' => 'bairro','type' => Form::INPUT_TEXT, 'options'=>['maxlength' => true]],
                    'numero_casa' => ['type' => Form::INPUT_TEXT, 'options'=>['placeholder' => 'Numero da Casa','maxlength' => true]],


                ]
            ]);

            ?>

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
                                return Html::a('<i class="glyphicon glyphicon-download">',["site/pdf",'informacao' => $model->data]
                                ,['data' =>[ 'method' => 'post']]);
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

<?php

$script = <<< JS

      $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                
            }
            
            //Quando o campo cep perde o foco.
            $("#cliente-cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#cliente-rua").val("...");
                        $("#cliente-bairro").val("...");
                       
                        //Consulta o webservice viacep.com.br/
                        $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#cliente-rua").val(dados.logradouro);
                                $("#cliente-bairro").val(dados.bairro);
                                
                               if(dados.rua == null){
                               
                               
                                $("#cliente-rua").val("Rua Não encontrada");
                               
                               }
                               
                               if(dados.bairo == null){
                               
                               
                                $("#cliente-bairro").val("Bairro Não encontrada");
                               
                               }
                                
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });


JS;

$this->registerJs($script);

?>

