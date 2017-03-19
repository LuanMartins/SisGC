<?php
/**
 * Created by PhpStorm.
 * User: Android0660
 * Date: 16/03/2017
 * Time: 21:57
 */




?>


<div class="row">
    <div class="col-md-12">
        <br/>
        <a class="btn btn-primary" href="index.php?r=site/index"> Voltar </a>
        <legend class="text-info">
            <div id="texto">
                <small><strong><center>Resultados</center></strong></small>
            </div>
        </legend>
        <?php \yii\widgets\Pjax::begin(); ?>
        <?php echo \yii\grid\GridView::widget(
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

        <?php \yii\widgets\Pjax::end(); ?>

    </div>

    <div id="valor_total">

        <div class="row">

            <div class="col-md-12">


               <h1> Valor Total </h1> <p><?= $valorTotal != 0 || $valorTotal != null? $valorTotal : 0?> R$</p>

            </div>
        </div>

    </div>

 
