<?php
/**
 * Created by PhpStorm.
 * User: Android0660
 * Date: 14/03/2017
 * Time: 22:45
 */


use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

\app\assets\SisgcAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
<?php $this->beginBody() ?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span>Lumino</span>Admin</a>
            <?php if(!Yii::$app->user->isGuest){?>
            <ul class="user-menu">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> User <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">

                        <li>
                        <?= Html::a('Logout', Url::to(['site/logout']), [
                                'data-confirm' => "Realmente Quer Sair ?", // <-- confirmation works...
                                'data-method' => 'post',
                                'data-params' => 'myParam=anyValue',
                                'class' => '<svg class="glyph stroked cancel"</svg> ',
                            ]
                        );
                        ?>
                        </li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </div>

    </div><!-- /.container-fluid -->
</nav>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">

    <br/>
    <ul class="nav menu">
        <li class="active"><a href="index.html"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
        <li><a href=<?= \yii\helpers\Url::to('index.php?r=site/index')?>><svg class="glyph stroked home""><use xlink:href="#stroked-home"></use></svg> Home</a></li>
        <li><a href=<?= \yii\helpers\Url::to('index.php?r=site/login')?>><svg class="glyph stroked male user"><use xlink:href="#stroked-male-user"></use></svg> Login</a></li>
        <li><a href=<?= \yii\helpers\Url::to('index.php?r=site/about')?>><svg class="glyph stroked eye"><use xlink:href="#stroked-eye"></use></svg> Sobre</a></li>
        <li><a href=<?= \yii\helpers\Url::to('index.php?r=site/contact')?>><svg class="glyph stroked two messages"><use xlink:href="#stroked-two-messages"></use></svg> Contato</a></li>

    </ul>

    <div class="attribution">Template by <a href="http://www.medialoot.com/item/lumino-admin-bootstrap-template/">Medialoot</a><br/><a href="http://www.glyphs.co" style="color: #333;">Icons by Glyphs</a></div>
</div><!--/.sidebar-->


<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">


              <?= $content ?>
                
                


        </div><!--/.col-->

        <!--/.col-->
    </div>

    <!--/.row-->
    <footer>
    <div class="row">
        <div class="col-lg-12">
            <div id="rodape">

            <a href="luanmartins.esy.es">Luan Martins - Soluções em Desenvolvimento &copy; <?= date('Y') ?> </a>
            </div>
        </div>
        </div>
        </footer>
</div>

<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
    