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
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="container">
            <div class="container-fluid">
                <div class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false"><span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="/">Hello Dashboard</a></div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="dropdown"><a href="/app90phut" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                                        aria-haspopup="true" aria-expanded="false">90phut<span
                                            class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/app90phut">90phut</a></li>
                                        <li><a href="/app433" >Bongda433</a></li>
                                        <li><a href="/saoplus" >Saoplus</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                                        aria-haspopup="true" aria-expanded="false">Xin chào,<?php echo Yii::$app->user->identity->fullname ?><span
                                            class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/admin/user/change-pass">Đổi mật khẩu</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="/admin/user/logout">Thoát</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="wrap-main">
                    <div class="col-md-9" id="right">
                        <script src="/libs/ckeditor/ckeditor.js?a=1"></script>
                        <?= $content ?>
                    </div>
                </div>
            </div>

        </div>

        <footer class="footer">
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
