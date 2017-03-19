<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="site-login">


    <legend class="text-info">
        <div id="texto">
            <small><strong><center><h1><?= Html::encode($this->title) ?></h1></center></strong></small>
        </div>
    </legend>


    <div class="pagina">
    <p>Digite os campos necessários para o efetuar o login:</p>




    <?php $form = ActiveForm::begin([
        'id' => 'login-form1',
        'layout' => 'horizontal',

    ]); ?>

        <?= $form->field($model, 'username')->textInput() ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

                <?php ActiveForm::end(); ?>
                
            </div>
        </div>



   </div>

    <?php if (Yii::$app->session->hasFlash('cadastroEfetuado')){ ?>

        <div class="alert bg-success" role="alert">
            <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg>
            Venda Efetuada Com Sucesso !!!
        </div>


    <?php }?>
    </div>

