<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Cadastro';
$this->params['breadcrumbs'][] = $this->title;
?>

<br>
<div class="row">

    <div id="login">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">Cadastre-se</div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin([


                    ]); ?>

                    <fieldset>
                        <div class="form-group">
                            <?= $form->field($model, 'username')->textInput(['class'=>'form-control','placeholder'=>'vendedor'])->label(false) ?>
                        </div>
                        <div class="form-group">
                            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control','placeholder' => 'senha'])->label(false) ?>

                        </div>

                        <?= Html::submitButton('Cadastrar', ['class' => 'btn btn-primary']) ?>



                        <?php ActiveForm::end(); ?>
                    </fieldset>

                </div>
            </div>
        </div>
    </div>

    <?php if (isset($flag) && $flag == true){ ?>
       <div id="alerta">
        <div class="alert bg-success" role="alert">
            <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg>
            Vendedor Cadastrado com Sucesso !!!
        </div>
       </div>

    <?php }?>
</div>
<!-- /.row -->
