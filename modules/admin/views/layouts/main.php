<?php

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

list(,$url) = Yii::$app->assetManager->publish('@mdm/admin/assets');
$this->registerCssFile($url.'/main.css');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <?php
        NavBar::begin([
            'brandLabel' => false,
            'options' => ['class' => 'navbar-inverse navbar-fixed-top'],
        ]);

        if (!empty($this->params['top-menu']) && isset($this->params['nav-items'])) {
            echo Nav::widget([
                'options' => ['class' => 'nav navbar-nav'],
                'items' => $this->params['nav-items'],
            ]);
        }

        echo Nav::widget([
            'options' => ['class' => 'nav navbar-nav navbar-right'],
            'items' => $this->context->module->navbar,
         ]);
        NavBar::end();
        ?>
<div class="container-fluid">
        <div class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false"><span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Hello Dashboard</a></div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                                aria-haspopup="true" aria-expanded="false">Bongda433<span
                                    class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Bongda433</a></li>
                                <li><a href="#">90phut</a></li>
                                <li><a href="#">Saoplus</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                                aria-haspopup="true" aria-expanded="false">
                                <?php 
                                    if(!Yii::$app->user->isGuest){
                                        echo Yii::$app->user->identity->username ;
                                    }
                                ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="/admin/user/change-password">Đổi mật khẩu</a></li>
                                <li role="separator" class="divider"></li>
                            
                                <li>
                                    <?php

                                echo  Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form']);
                                echo Html::submitButton('Logout',['class' => 'btn btn-link'] );
                                echo Html::endForm();
                                        ?>
                               </li>

            
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
        <div class="container">
            <?= $content ?>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
