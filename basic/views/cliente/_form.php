<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'contentBefore' => '<legend class="text-info"><small>Dados Pessoais</small></legend>',
        'columns'=>3,
        'attributes'=>[       // 2 column layout
            'nome'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nome do Cliente','maxlength' => true]],
            'apelido'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder' => 'Apelido do Cliente (opcional)','maxlength' => true]],
            'cpf' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => \yii\widgets\MaskedInput::className(), 'options'=>[


                'mask' => '999.999.999-99',
            ],
            ]
        ]
    ]);

    ?>
    <div id="teste"></div>

    <?php echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>2,
        'attributes'=>[       // 2 column layout

            'telefone' => ['type' => Form::INPUT_WIDGET,'widgetClass' => \yii\widgets\MaskedInput::className(),'options' =>[

                'mask' => '(999)9-9999-9999',

            ]],

            'limite_credito' => ['type' => Form::INPUT_TEXT, 'options'=>['class' =>'limite','placeholder' => 'Limite de Crédito','maxlength' => true]],

        ]
    ]);

    ?>




    <?php echo Form::widget([
        'model'=>$model,
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
        'model'=>$model,
        'form'=>$form,
        'columns'=>2,
        'attributes'=>[       // 2 column layout

            'bairro' => ['id' => 'bairro','type' => Form::INPUT_TEXT, 'options'=>['maxlength' => true]],
            'numero_casa' => ['type' => Form::INPUT_TEXT, 'options'=>['placeholder' => 'Numero da Casa','maxlength' => true]],


        ]
    ]);

    ?>


    <div class="row">
        <div class="col-md-11 text-center">

         </div>

    </div>
    <br>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>




</div>

<?php

$script = <<< JS


 
      $(document).ready(function() {

          
          // tentando setar mascara de valor para o campo de id = venda_valor
          // $("#venda-valor").mask('000.000.000.000.000,00');
           
           
            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                
            }
            
         
            $("#cliente-limite_credito").mask('000.000.000.000.000.00',{reverse:true});
            $("#venda-valor").mask('000.000.000.000.000.00',{reverse:true});
            
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
                        $(".col-md-11").html("<div class='alert-warning'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i><p> Busncando Informações</p></div>");
                        $("#cliente-rua").val("...");
                        $("#cliente-bairro").val("...");
                       
                        //Consulta o webservice viacep.com.br/
                        $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#cliente-rua").val(dados.logradouro);
                                $("#cliente-bairro").val(dados.bairro);
                                $(".col-md-11").html("<div class='alert-success'><i class='fa fa-3x fa-check'> Sucesso</i></div>");
                            }   
                          
                               if(dados.logradouro == null){
                               
                               
                                $("#cliente-rua").val("Rua Não encontrada");
                               
                               }
                               
                               if(dados.bairro == null){
                               
                               
                                $("#cliente-bairro").val("Bairro Não encontrada");
                               
                               }
                                
                             //end if.
                            
                        }).fail(function() {
                          
                            $(".col-md-11").html("<div class='alert-danger'><i class='fa fa-3x fa-exclamation-triangle'> Conexão Perdida</i></div>");
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                         $(".col-md-11").html("<div class='alert-danger'><i class='fa fa-3x fa-align-left fa-exclamation-triangle '> Cep Invalido</i></div>");
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

