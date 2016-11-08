<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\modules\app90phut\services\Utility;

if (isset($_REQUEST['page'])) {
    $this->title = 'Trang ' . $_REQUEST['page'] . ' - Danh sách video';
} else
    $this->title = 'Danh sách video';
?>
<div class="list-item-index">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tìm kiếm</h3>
        </div>
        <div class="panel-body" id="panel-search">
            <form id="searchForm" action="/app90phut/video" method="get">
                <div class="col-md-5 form-group ">
                    <label>Từ khóa</label>
                    <input id="Keyword" name="keyword" class="form-control" type="text" value="">
                </div>

                <div class="col-md-5">
                    <div class="col-md-6 form-group ">
                        <label>Chuyên mục</label>
                        <select id="category" name="category" class="selectpicker bs-select-hidden">
                            <option value="0" >-Tất Cả-</option>

                            <?php foreach ($param['categories'] as $key => $value) { ?>
                                <option value="<?= $key ?>" ><?= $value ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6 form-group ">
                        <label>Nhóm tin</label>
                        <select id="Type" name="type" class="selectpicker bs-select-hidden">
                            <option value="0" <?= ($param['type'] == 0) ? "selected" : "" ?>>Tất cả</option>
                            <option value="1" <?= ($param['type'] == 1) ? "selected" : "" ?>>Video ẩn</option>
                            <option value="2" <?= ($param['type'] == 2) ? "selected" : "" ?>>Video Ghim</option>
                            <option value="2" <?= ($param['type'] == 3) ? "selected" : "" ?>>Video Chuyên mục</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2 pull-right text-right clearfix form-group ">
                    <button class="btn btn-default" style="margin-top:24px" type="submit">Tìm Kiếm</button>
                </div>
                <div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="col-md-8 remove-padding">
                <h3 class="panel-title">Danh sách video</h3>
            </div>
            <div class="col-md-4 remove-padding">
                <div class="btn-group" style="float:right;">
                    <a href="/app90phut/video/create" 
                       type="button" 
                       class="btn btn-sm btn-success">
                        <i class="glyphicon glyphicon-plus"></i>&nbsp;Thêm mới
                    </a>
                    <!--                    <button type="button" 
                                                class="btn btn-sm btn-success dropdown-toggle" 
                                                data-toggle="dropdown" 
                                                aria-haspopup="true" 
                                                aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>-->
                    <!--                    <ul class="dropdown-menu">
                                            <li><a href="/app433/post/list-news">Chuyên mục mobile</a></li>
                                            <li><a href="/app433/post/list-news">Chuyên mục PC</a></li>
                                        </ul>-->
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
                        $img = '/service/' . $item['Avatar'];
                        $title = $item['EventName'];
                        $link = "";
                        $top = $item["Top"];
                        $tophot = $item["Tophot"];
                        ?>
                        <tr id="listPost<?= $id ?>">
                            <th scope="row"><?= $id ?></th>
                            <td>
                                <ul class="media-list">
                                    <li class="media">
                                        <div class="media-left">
                                            <a href="#"> 
                                                <img class="img90phut" src="<?= $img; ?>" data-holder-rendered="true"> 
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <div class="head">
                                                <h4 class="media-heading post-index-h4">
                                                    <a href="/app90phut/video/update?id=<?php echo $id ?>&urlback=<?= $param['urlback'] ?>"><?= $item['Name'] ?></a>

                                                    <label class="blue-type item"  style="<?= (!$top) ? "display:none" : "" ?>" data-ghim-label="8412">Ghim</label>
                                                    <label class="primary-type item" style="<?= (!$tophot) ? "display:none" : "" ?>"  data-top-label="8412">Ghim chuyên mục</label>
                                                    <input type="text" 
                                                           id="linkCopy<?= $id ?>" 
                                                           class="linkCopy" 
                                                           value="http://90phut.vn/<?= $link ?>.html"/>
                                                </h4>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="content">
                                                <span class="cotentArt"><?= $title; ?></span>
                                            </div>
                                            <div style="width: 100%;position: relative;">
                                                <span class="post-index-fullname" style="margin-top: 5px;">
                                                    Tạo bởi : <?= $item['FullName']; ?> 
                                                    | Cập nhật: <?= Utility::formatDateTime($item['DateUpdate']) ?>
                                                    <br/>

                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown"
                                            class="btn btn-default btn-sm dropdown-toggle" type="button">
                                        <span class="glyphicon glyphicon-cog"></span> 
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-header"></li>
                                        <li><a href="/app90phut/video/update?id=<?php echo $id ?>&urlback=<?= $param['urlback'] ?>">Chỉnh sửa</a></li>
                                        <li><a href="javascript:void(0);" onClick="copyfieldvalue(<?= $id ?>);">Copy Link</a></li>
                                        <li><a href="/app90phut/video/top?id=<?= $id ?>&urlback=<?= $param['urlback'] ?>"><?= ($top) ? "Bỏ Ghim" : "Ghim" ?></a></li>
                                        <li><a href="/app90phut/video/top-hot?id=<?= $id ?>&urlback=<?= $param['urlback'] ?>"><?= ($tophot) ? "Bỏ Ghim CM" : "Ghim CM" ?></a></li>
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
