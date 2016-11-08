<?php

use app\modules\app90phut\services\AdminService;

$adminService = new AdminService();
$listAdmin = $adminService->getListAdmin();

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Danh sách nội dung ghim slider pc';
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
    <?php if (isset($_GET['mes']) && $_GET['mes'] != '') { ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?= $_GET['mes']; ?>
        </div>
    <?php } ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Danh sách ghim slider PC</h3>
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
                        $img = $item['Image'];
                        $title = $item['Title'];
                        ?>
                        <tr id="listPost<?= $id ?>">
                            <th scope="row"><?= $id ?></th>
                            <td>
                                <ul class="media-list">
                                    <li class="media">
                                        <div class="media-left">
                                            <a href="#"> 
                                                <img style="width:60px;" src="http://90phut.vn/service/<?= $img; ?>" data-holder-rendered="true"> 
                                            </a>
                                        </div>
                                        <div class="media-body">

                                            <div class="content">
                                                <span class="cotentArt"><?= $title; ?></span>
                                            </div>
                                            <div style="width: 100%;position: relative;">
                                                <span class="post-index-fullname" style="margin-top: 5px;">
                                                    Tạo bởi : <?php
                                                    $userCreate = $item['UserCreate'];
                                                    if (isset($listAdmin[$userCreate])) {
                                                        echo $listAdmin[$userCreate];
                                                    }
                                                    ?> 
                                                    | Xuất bản: <?= date("d-m-Y H:i:s", strtotime($item['DateCreate'])); ?>
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
                                        <li><a href="/app90phut/pin-slider/delete?id=<?php echo $id ?>&redirect=90phut">Xóa</a></li>
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

