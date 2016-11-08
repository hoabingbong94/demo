<?php

use app\modules\app90phut\services\AlbumService;

$albumService = new AlbumService();
$listCategories = $albumService->listCategoriesAlbum();

use yii\helpers\Html;
use yii\widgets\LinkPager;

if (isset($_REQUEST['page'])) {
    $this->title = 'Trang ' . $_REQUEST['page'] . ' - Danh sách album bóng hồng';
} else
    $this->title = 'Danh sách album bóng hồng';
?>
<div class="list-item-index">
    <div class="topOption">
        <div class="remove-padding" style="width: 39%;">
            <ul class="filterPost">
                <li><a href="/app90phut/album">Tất cả</a></li>
                <li><a href="/app90phut/album?public=0">Tin ẩn</a></li>
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
                <h3 class="panel-title">Danh sách album bóng hồng</h3>
            </div>
            <div class="col-md-4 remove-padding">
                <div class="btn-group" style="float:right;">
                    <button onClick="popupChoiceTypeAdd();" class="btn btn-sm btn-success">
                        <i class="glyphicon glyphicon-plus"></i>&nbsp;Thêm mới</button>
                </div>
            </div>
            <div class="modal fade in" 
                 id="modal-add-post" 
                 tabindex="-1" 
                 role="dialog" 
                 aria-labelledby="Modle_Video_HighlightLable">
                <div class="modal-dialog" role="document"style="width: 330px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 style="font-size: 16px;" class="modal-title">Chọn kiểu album</h4>
                        </div>
                        <div class="modal-body">
                            <div class="list-group" style="width: 300px;margin: 0 auto">
                                <a class="list-group-item" href="/app90phut/album/create?type=0">Album ảnh
                                    <i class="glyphicon glyphicon-chevron-right pull-right"></i>
                                </a>
                                <a class="list-group-item" href="/app90phut/album/create?type=1">Album video
                                    <i class="glyphicon glyphicon-chevron-right pull-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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
                        $img = $item['Avatar'];
                        $title = $item['AlbumName'];
                        ?>
                        <tr id="listPost<?= $id ?>">
                            <th scope="row"><?= $id ?></th>
                            <td>
                                <ul class="media-list">
                                    <li class="media">
                                        <div class="media-left">
                                            <a href="#"> 
                                                <img style="width:60px;" src="<?= Yii::$app->params['media90phut'] . $img; ?>" data-holder-rendered="true"> 
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <div class="head">
                                                <h4 class="media-heading post-index-h4">
                                                    <?php
                                                    if (isset($listCategories[$item['CategoryID']])) {
                                                                    echo $listCategories[$item['CategoryID']];
                                                }
                                                ?>
                                            </h4>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="content">
                                            <span class="cotentArt"><?= $title; ?></span>
                                        </div>
                                        <div style="width: 100%;position: relative;">
                                            <span class="post-index-fullname" style="margin-top: 5px;">
                                                Tạo bởi : <?= $item['Author']; ?> 
                                                | Xuất bản: <?= date("d-m-Y H:i:s", strtotime($item['DateCreate'])); ?>
                                                        |  <?php
                                                                if ($item['Type'] == 1) {
                                                echo '<i title="Album video" class="iconType glyphicon glyphicon-facetime-video"></i>';
                                                } else {
                                                echo '<i title="Album hình ảnh" class="iconType  glyphicon glyphicon-picture"></i>';
                                                }
                                                ?>
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
                                    <li><a href="/app90phut/album/update?id=<?php echo $id ?>&redirect=90phut">Chỉnh sửa</a></li>
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
