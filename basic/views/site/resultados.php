<?php
/**
 * Created by PhpStorm.
 * User: Android0660
 * Date: 16/03/2017
 * Time: 21:57
 */


use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>


<div class="row">
    <div class="col-md-12">
        <br/>

        <a class="btn btn-primary" href="index.php?r=site/index"> Voltar </a>


            <?php if (!Yii::$app->user->isGuest){?>
        <div id="componente">
                <div class="row">
                    <div class="col-md-12">

                        <legend class="text-info">
                            <div id="texto">
                                <small><strong><center>Pesquise Pelo Cliente</center></strong></small>
                            </div>
                        </legend>

                        <?php $form = ActiveForm::begin(['method' => 'post']); ?>


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



            <?php }?>

        </div>

        <?php  \yii\widgets\Pjax::begin(); ?>
    <div id="grid">
        <?php if(isset($dataProvider)){ echo \yii\grid\GridView::widget(
            [
                'dataProvider' => $dataProvider,
                

                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'compradorIdcomprador.nome',
                    'valor',
                    //'compradorIdcomprador.nome',

                    ['class' => 'yii\grid\ActionColumn',

                        'template' => '{atualizar}',

                        'buttons' =>[

                            'atualizar' => function ($url,$model,$key){

                                return \yii\helpers\Html::a('<i class="glyphicon glyphicon-pencil">', ['venda/view', 'id'=>$model->idcompra,'nome' => $model->compradorIdcomprador->nome]);

                            }

                        ],




                    ],
                ],
            ]



        )?>
        </div>
        <?php \yii\widgets\Pjax::end();
        } ?>

    </div>

    <?php  if(isset($dataProvider)){?>
    <div id="valor_total">

        <div class="row">

            <div class="col-md-12">


               <h1> Valor Total </h1> <p><?= isset($valorTotal)? $valorTotal : 0?> R$</p>

            </div>
        </div>

    </div>
<?php }?>

 
