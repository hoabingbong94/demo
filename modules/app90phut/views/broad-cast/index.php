<?php

use app\modules\app90phut\services\AdminService;

$adminService = new AdminService();
$listAdmin = $adminService->getListAdmin();

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Danh sách lịch truyền hình';
?>
<div class="list-item-index">

    <!--Input tìm kiếm-->
    <div class="panel panel-default">
        <div class="panel-body" id="panel-search">
            <form id="searchForm" action="" method="get">
                <div class="col-md-12">
                    <div class="col-md-7 form-group ">
                        <label>Từ khóa</label>
                        <input id="Keyword" name="keyword" class="form-control" type="text" value="<?= $keyword ?>">
                    </div>
                    <div class="col-md-3 form-group ">
                        <label>Ngày</label>
                        <input onblur="loaddate();" onClick="loaddate();" id="datetimepicker3" name="date" class="form-control hasDatepicker" type="text" value="<?= $date ?>">

                    </div>
                    <div class="col-xs-2 pull-right text-right clearfix form-group ">
                        <button class="btn btn-default" style="margin-top:24px" type="submit">Tìm Kiếm</button>
                    </div>
                </div>
                <div>
                </div>
            </form>
        </div>
    </div>
    <!-------------------->
    <div class="clearfix"></div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="col-md-8 remove-padding">
                <h3 class="panel-title">Danh sách lịch truyền hình</h3>
            </div>
            <div class="col-md-4 remove-padding">
                <a href="/app90phut/broad-cast/create" class="btn btn-sm btn-success pull-right dropdown-toggle">
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
                        $id = $item->ID;
                        $title = $item->HomeName . " <i class='score-broat-cast'>vs</i> " . $item->AwayName;
                        $dateTime = $item->Date_BroadCast . " " . $item->Time_BroadCast;
                        ?>
                        <tr id="listPost<?= $id ?>">
                            <th scope="row"><?= $id ?></th>
                            <td>
                                <ul class="media-list">
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="head">
                                                <h4 class="media-heading post-index-h4">
                                                    <?= $title ?>
                                                </h4>
                                                <span class="minute">
                                                    <?= date("d-m-Y H:i:s", strtotime($dateTime)) ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="content">
                                                <span class="cotentArt"><?= $item->Channel; ?></span>
                                            </div>
                                            <div style="width: 100%;position: relative;">
                                                <span class="post-index-fullname" style="margin-top: 5px;">
                                                    Tạo bởi : <?php
                                                    $userCreate = $item->UserCreate;
                                                    if (isset($listAdmin[$userCreate])) {
                                                        echo $listAdmin[$userCreate];
                                                    }
                                                    ?> 
                                                    | Xuất bản: <?= date("d-m-Y H:i:s", strtotime($item->DateCreate)); ?>
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
                                        <li><a href="/app90phut/broad-cast/update?id=<?php echo $id ?>&redirect=90phut">Chỉnh sửa</a></li>
                                        <li><a href="/app90phut/broad-cast/delete?id=<?= $id ?>">Xoá</a></li>
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
