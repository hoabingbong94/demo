<?php

//$listRole = Yii::$app->getAuthManager()->getPermissionsByUser(Yii::$app->user->getId());
use app\modules\app90phut\services\AdminService;

$adminService = new AdminService();
$listAdmin = $adminService->getListAdmin();

use yii\helpers\Html;
use yii\widgets\LinkPager;

if (isset($_REQUEST['page'])) {
    $this->title = 'Trang ' . $_REQUEST['page'] . ' - Danh sách tin ngôi sao';
} else
    $this->title = 'Danh sách tin ngôi sao';
?>
<div class="list-item-index">
    <div class="topOption">
        <div class="remove-padding" style="width: 39%;">
            <ul class="filterPost">
                <li><a href="/app90phut/star">Tất cả</a></li>
                <li><a href="/app90phut/star?public=0">Tin ẩn</a></li>
            </ul>
        </div>
        <!--Input tìm kiếm-->
        <div class="search">
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group">
                        <form method="get">
                            <input type="text" 
                                   class="form-control" 
                                   placeholder="Tìm kiếm..." 
                                   name="keyword"
                                   style="width: 230px;"
                                   value="<?= isset($_GET['keyword']) ? Html::encode($_GET['keyword']) : ''; ?>"/>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">Tìm kiếm</button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-------------------->
        <div class="clearfix"></div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="col-md-8 remove-padding">
                <h3 class="panel-title">Danh sách tin ngôi sao</h3>
            </div>
            <div class="col-md-4 remove-padding">
                <a href="/app90phut/star/create" class="btn btn-sm btn-success pull-right dropdown-toggle">
                    <i class="glyphicon glyphicon-plus"></i>&nbsp;Đăng tin</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <table class="table table-style">
                <thead>
                    <tr>
                        <th style="width: 50px">ID</th>
                        <th>Nội dung</th>
                        <th width="30">#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $item) {
                        $id = $item['ID'];
                        $img = \Yii::$app->params['media90phut'] . $item['Thumbnails'];
                        $title = $item['Summary'];
                        ?>
                        <tr id="listPost<?= $id ?>">
                            <th scope="row"><?= $id ?></th>
                            <td>
                                <ul class="media-list">
                                    <li class="media">
                                        <div class="media-left">
                                            <a href="#"> 
                                                <img style="width:60px;" src="<?= $img; ?>" data-holder-rendered="true"> 
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <div class="head">
                                                <h4 class="media-heading post-index-h4">
                                                    <?php echo $item['Title'] ?>
                                                </h4>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="content">
                                                <span class="cotentArt"><?= $title; ?></span>
                                            </div>
                                            <div style="width: 100%;position: relative;">
                                                <span class="post-index-fullname" style="margin-top: 5px;">
                                                    Tạo bởi : <?php
                                                    $userCreate = $item['UserCreate'];
                                                    if (isset($listAdmin[$userCreate])) {
                                                        echo $listAdmin[$userCreate];
                                                    } else {
                                                        echo $item['Author'];
                                                    }
                                                    ?> 
                                                    | Xuất bản: <?= date("d-m-Y H:i:s", strtotime($item['ReleaseDate'])); ?>
                                                    <br/>
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button aria-expanded="false" 
                                            aria-haspopup="true" 
                                            data-toggle="dropdown" 
                                            class="btn btn-default btn-xs dropdown-toggle" 
                                            type="button">
                                        <span class="glyphicon glyphicon-option-horizontal"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-header"></li>
                                        <li><a href="/app90phut/star/update?id=<?php echo $id ?>&redirect=90phut">Chỉnh sửa</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<nav>
    <?=
    LinkPager::widget([
        'pagination' => $pagination, 'maxButtonCount' => 10])
    ?>

</nav>
