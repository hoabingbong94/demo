<?php

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
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
        <?php
        $this->beginBody();
        $controller = $this->context;
        $route = $controller->route;
        ?>
    </head>
    <body>

        <?php if (strpos($route, 'admin/user/login') !== 0) { ?>
            <header>
                <div class="container">
                    <div class="container-fluid">
                        <div class="navbar navbar-inverse">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false"><span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                                    </button>
                                    <a class="navbar-brand" href="/"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard <span style="font-size: 11px;position: relative">v2.0</span></a></div>
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <ul class="nav navbar-nav" id="menu">
                                        <li class="<?= Yii::$app->controller->module->id == 'app433' ? 'active' : '' ?>"><a href="/app433">Bongda433</a></li>
                                        <li class="<?= Yii::$app->controller->module->id == 'app90phut' ? 'active' : '' ?>"><a href="/app90phut/news">90phut</a></li>
                                        <li class="<?= Yii::$app->controller->module->id == 'admin' ? 'active' : '' ?>"><a href="/admin">Admin</a> </li>
                                        <li class="<?= Yii::$app->controller->module->id == 'saoplus' ? 'active' : '' ?>"><a href="/saoplus">Administrator</a> </li>

                                    </ul>
                                    <ul class="nav navbar-nav navbar-right">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                               aria-haspopup="true" aria-expanded="false">Xin chào, 
                                                   <?php
                                                   if (!Yii::$app->user->isGuest)
                                                       echo Yii::$app->user->identity->fullname;
                                                   else
                                                       echo 'Khách'
                                                       ?>
                                                <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <?php if (Yii::$app->user->isGuest) { ?>
                                                    <li><a href="/admin/user/login">Đăng nhập</a> </li>
                                                <?php } else { ?>
                                                    <li class="<?= (Yii::$app->controller->id == 'user' && Yii::$app->controller->action->id == 'change-password') ? 'active' : '' ?>"><a href="/admin/user/change-password"><i class="fa fa-key" aria-hidden="true"></i> Đổi mật khẩu</a></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li><a href="/admin/user/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Thoát</a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        <?php } ?>
        <div class="container">

            <div class="container-fluid">
                <div class="wrap-main">
                    <!--<script src="/libs/ckeditor/ckeditor.js?v=2"></script>-->
                    <?= $content ?>
                </div>
            </div>

        </div>

        <footer class="footer">
        </footer>

        <?php $this->endBody() ?>

    </body>
</html>
<?php $this->endPage() ?>
