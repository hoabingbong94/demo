<?php
/**
 * Created by PhpStorm.
 * User: Hoàng
 * Date: 25/05/2016
 * Time: 4:10 CH
 */
?>

<?php

use yii\helpers\Url;

$controller = $this->context;
$route = $controller->route;
$urlcurent = Url::current();
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="col-md-3" id="left">

    <div class="clearfix"></div>
    <div class="list-group" id="contentMenu">
        <div class="panel-group edit-menu" id="accordion" role="tablist" aria-multiselectable="true">

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <?php
                    //var_dump(strpos($route, 'app90phut/category-video')); die;
                    $in = "";
                    $expanded = 'false';
                    if (((strpos($route, 'app90phut/category') === 0 && strpos($route, 'app90phut/category-video') === false) ) || strpos($route, 'app90phut/news') === 0) {
                        $in = 'in';
                        $expanded = 'true';
                    }
                    ?>
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#newsmenu" href="#newsmenuchild" aria-expanded="<?= $expanded ?>" aria-controls="collapseOne">
                            <i class="fa fa-file-text-o icon" aria-hidden="true"></i> Tin tức
                            <i class="glyphicon glyphicon-chevron-down pull-right"></i>
                        </a>
                    </h4>
                </div>
                <div id="newsmenuchild" class="panel-collapse collapse <?= $in ?>" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <ul>
                            <a href="/app90phut/category"><li class="<?= (strpos($route, 'app90phut/category') === 0 and strpos($route, 'app90phut/category-video') === false) ? 'active' : '' ?>">Chuyên mục tin</li></a>
                            <a href="/app90phut/news"><li class="<?= (strpos($route, 'app90phut/news') === 0 && strpos($route, 'app90phut/news/create') === false) ? 'active' : '' ?>">Danh sách tin</li></a>
                            <a href="/app90phut/news/create"><li class="<?= (strpos($route, 'app90phut/news/create') === 0) ? 'active' : '' ?>">Thêm mới tin</li></a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <?php
                    $in = "";
                    $expanded = 'false';
                    if (strpos($route, 'app90phut/video') === 0 || strpos($route, 'app90phut/category-video') === 0) {
                        $in = 'in';
                        $expanded = 'true';
                    }
                    ?>
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#videomenu" href="#videomenuchild" aria-expanded="<?= $expanded ?>" aria-controls="collapseOne">
                            <i class="fa fa-youtube-play icon" aria-hidden="true"></i> Video
                            <i class="glyphicon glyphicon-chevron-down pull-right"></i>
                        </a>
                    </h4>
                </div>
                <div id="videomenuchild" class="panel-collapse collapse <?= $in ?>" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <ul>
                            <a href="/app90phut/category-video"><li class="<?= (strpos($route, 'app90phut/category-video') === 0) ? 'active' : '' ?>">Chuyên mục video</li></a>
                            <a href="/app90phut/video"><li class="<?= (strpos($route, 'app90phut/video') === 0 && strpos($route, 'app90phut/video/create') === false && strpos($urlcurent, 'app90phut/video/index?app90phut%2Fvideo=&type=2') === false) ? 'active' : '' ?>">Danh sách video</li></a>
                            <a href="/app90phut/video?type=2"><li class="<?= (strpos($urlcurent, 'app90phut/video/index?app90phut%2Fvideo=&type=2') !== false ) ? 'active' : '' ?>">Danh sách video ghim</li></a>
                            <a href="/app90phut/video/create"><li class="<?= (strpos($route, 'app90phut/video/create') === 0) ? 'active' : '' ?>">Thêm mới video </li></a>                        
                        </ul>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <?php
                    $in = "";
                    $expanded = 'false';
                    if (strpos($route, 'app90phut/soccer-match-info') === 0 || strpos($route, 'app90phut/soccer-league-info') === 0) {
                        $in = 'in';
                        $expanded = 'true';
                    }
                    ?>
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#soccermenu" href="#soccermenuchild" aria-expanded="<?= $expanded ?>" aria-controls="collapseOne">
                            <i class="fa fa-trophy icon" aria-hidden="true"></i> Trận đấu
                            <i class="glyphicon glyphicon-chevron-down pull-right"></i>
                        </a>
                    </h4>
                </div>
                <div id="soccermenuchild" class="panel-collapse collapse <?= $in ?>" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <ul>
                            <a href="/app90phut/soccer-league-info"><li class="<?= (strpos($route, 'app90phut/soccer-league-info') === 0) ? 'active' : '' ?>">Danh sách giải đấu</li></a>
                            <a href="/app90phut/soccer-match-info"><li class="<?= (strpos($route, 'app90phut/soccer-match-info') === 0 && strpos($route, 'app90phut/soccer-match-info/create') === false) ? 'active' : '' ?>">Danh sách trận đấu</li></a>
                            <a href="/app90phut/soccer-match-info/create"><li class="<?= (strpos($route, 'app90phut/soccer-match-info/create') === 0) ? 'active' : '' ?>">Thêm mới trận</li></a>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <?php
                    $in = "";
                    $expanded = 'false';
                    if (strpos($route, 'app90phut/star') === 0) {
                        $in = 'in';
                        $expanded = 'true';
                    }
                    ?>
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#starmenu" href="#starmenuchild" aria-expanded="<?= $expanded ?>" aria-controls="collapseOne">
                            <i class="fa fa-star-o icon" aria-hidden="true"></i> Ngôi sao
                            <i class="glyphicon glyphicon-chevron-down pull-right"></i>
                        </a>
                    </h4>
                </div>
                <div id="starmenuchild" class="panel-collapse collapse <?= $in ?>" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <ul>
                            <a href="/app90phut/star"><li class="<?= (strpos($route, 'app90phut/star') === 0 && strpos($route, 'app90phut/star/create') === false) ? 'active' : '' ?>">Danh sách ngôi sao</li></a>
                            <a href="/app90phut/star/create"><li class="<?= (strpos($route, 'app90phut/star/create') === 0 ) ? 'active' : '' ?>">Thêm mới ngôi sao </li></a>                        
                        </ul>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <?php
                    $in = "";
                    $expanded = 'false';
                    if (strpos($route, 'app90phut/album') === 0) {
                        $in = 'in';
                        $expanded = 'true';
                    }
                    ?>
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#albummenu" href="#albummenuchild" aria-expanded="<?= $expanded ?>" aria-controls="collapseOne">
                            <i class="fa fa-female icon" aria-hidden="true"></i> Bóng hồng
                            <i class="glyphicon glyphicon-chevron-down pull-right"></i>
                        </a>
                    </h4>
                </div>
                <div id="albummenuchild" class="panel-collapse collapse <?= $in ?>" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <ul>
                            <a href="/app90phut/album"><li class="<?= (strpos($route, 'app90phut/album') === 0 && strpos($route, 'app90phut/album/create') === false) ? 'active' : '' ?>">Danh sách bóng hồng</li></a>
                            <a href="/app90phut/album/create?type=0"><li class="<?= (strpos($urlcurent, 'app90phut/album/create?app90phut%2Falbum%2Fcreate=&type=0') !== false ) ? 'active' : '' ?>">Thêm mới album ảnh </li></a>                        
                            <a href="/app90phut/album/create?type=1"><li class="<?= (strpos($urlcurent, 'app90phut/album/create?app90phut%2Falbum%2Fcreate=&type=1') !== false ) ? 'active' : '' ?>">Thêm mới album video </li></a>                        
                        </ul>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <?php
                    $in = "";
                    $expanded = 'false';
                    if (strpos($route, 'app90phut/broad-cast') === 0) {
                        $in = 'in';
                        $expanded = 'true';
                    }
                    ?>
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#broad-castmenu" href="#broad-castmenuchild" aria-expanded="<?= $expanded ?>" aria-controls="collapseOne">
                            <i class="fa fa-television icon" aria-hidden="true"></i> Lịch truyền hình
                            <i class="glyphicon glyphicon-chevron-down pull-right"></i>
                        </a>
                    </h4>
                </div>
                <div id="broad-castmenuchild" class="panel-collapse collapse <?= $in ?>" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <ul>
                            <a href="/app90phut/broad-cast"><li class="<?= (strpos($route, 'app90phut/broad-cast') === 0 && strpos($route, 'app90phut/broad-cast/create') === false) ? 'active' : '' ?>">Danh sách lịch</li></a>
                            <a href="/app90phut/broad-cast/create"><li class="<?= (strpos($route, 'app90phut/broad-cast/create') === 0 ) ? 'active' : '' ?>">Thêm mới lịch </li></a>                        
                        </ul>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <?php
                    $in = "";
                    $expanded = 'false';
                    if (strpos($route, 'app90phut/categories-pc') === 0 || strpos($route, 'app90phut/pin-slider') === 0) {
                        $in = 'in';
                        $expanded = 'true';
                    }
                    ?>
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="<?= $expanded ?>" aria-controls="collapseOne">
                            <i class="fa fa-desktop icon" aria-hidden="true"></i> 90phut PC
                            <i class="glyphicon glyphicon-chevron-down pull-right"></i>
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse <?= $in ?>" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <ul>
                            <a href="/app90phut/categories-pc"><li class="<?= (strpos($route, 'app90phut/categories-pc') === 0) ? 'active' : '' ?>">Chuyên mục PC</li></a>
                            <a href="/app90phut/pin-slider"><li class="<?= (strpos($route, 'app90phut/pin-slider') === 0) ? 'active' : '' ?>">Ghim slider PC</li></a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed" href="/app90phut/report" aria-expanded="<?= (strpos($route, 'app90phut/report') === 0) ? 'true' : 'false' ?>">
                            <i class="fa fa-area-chart icon" aria-hidden="true"></i> Report
                            <!--<i class="glyphicon glyphicon-chevron-right pull-right"></i>-->
                        </a>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-9" id="right">
    <script src="/libs/ckeditor_90phut/ckeditor.js?v=2"></script>
    <?= $content ?>
</div>
<?php
$this->endContent();
