<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\services\FunctionStatic;

if (isset($_REQUEST['page'])) {
    $this->title = 'Trang ' . $_REQUEST['page'] . ' - Tin tức';
} else
    $this->title = 'Tin tức';
?>
<div id="news">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tìm kiếm</h3>
        </div>
        <div class="panel-body" id="panel-search">
            <form id="searchForm" action="/app90phut/news" method="get">
                <div class="col-md-5 form-group ">
                    <label>Từ khóa</label>
                    <input id="keyword" name="keyword" class="form-control" type="text" value="<?= $param['keyword'] ?>">
                </div>

                <div class="col-md-5">
                    <div class="col-md-6 form-group ">
                        <label>Chuyên mục</label>
                        <select id="category" name="category" class="selectpicker bs-select-hidden">
                            <option value="0" <?= ($param['category'] == 0) ? "selected" : "" ?>>-Tất Cả-</option>

                            <?php foreach ($category as $row) { ?>
                                <option value="<?= $row->CategoryID ?>" <?= ($param['category'] == $row->CategoryID) ? "selected" : "" ?>><?= $row->CategoryName ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 form-group ">
                            <label>Nhóm tin</label>
                            <select id="type" name="type" class="selectpicker bs-select-hidden">
                                <option value="0" <?= ($param['type'] == 0)  ? "selected"   : "" ?>>Tất cả</option>
                                <option value="1" <?= ($param['type'] == 1)  ? "selected"   : "" ?>>Tin GM</option>
                                <option value="2" <?= ($param['type'] == 2)  ? "selected"   : "" ?>>Tin VIP</option>
                                <option value="2" <?= ($param['type'] == 3)  ? "selected"   : "" ?>>Tin TOP</option>
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
                    <h3 class="panel-title">Danh chuyên mục</h3>
                </div>
                <div class="col-md-4 remove-padding">
                    <a href="/app90phut/news/create" class="btn btn-sm btn-success pull-right">
                        <span class="glyphicon glyphicon-plus"></span>Thêm mới</a>
                </div>
                <div class="clearfix"></div>

            </div>
            <div class="panel-body">
                <table class="table table-news">

                    <tbody>
                        <?php foreach ($data["data"] as $row) {
                        ?>
                        <tr>
                             <td>
                                <div class="image-intro">
                                    <img  src="<?= \Yii::$app->params['media90pro'] . $row["Thumbnails"] ?>"/>

                                </div>
                            </td>
                            <td>
                                <div class="content-right-info">
                                    <a class="title" href="/app90phut/news/update?id=<?= $row["ID"] ?>&urlback=<?= $param['urlback'] ?>"
                                       title="Sửa"><?= $row["Title"] ?>
                                    </a>
                                    <label class="color-category"><?= $row["CategoryName"] ?></label>
                                    <label class="description"><?= $row["Summary"] ?></label>
                                    <label class="date-time"><?= $row["ExtendUpdateDate"] ?></label>
                                    <label class="author"><?= $row["Author"] ?></label>

                                    <div class="clearfix" ></div>

                                    <?= ($row["ExtendVip"] == 2)  ? '<label class="blue-type item" title="Tin Vip">VIP</label>'   : '' ?>
                                    <?= ($row["ExtendVip"] == 1)  ? '<label class="primary-type item" title="Tin GM">GM</label>'   : '' ?>
                                    <?= ($row["ExtendTop"] == 1)  ? '<label class="red-type item" title="Bài ghim trên đầu chuyên mục">TOP</label>'   : '' ?>
                                    <?= ($row["ExtendHot"] == 1)  ? '<label class="red-type item" title="Bài hiển thị trên đầu chuyên mục">HOT</label>'   : '' ?>
                                    <?= ($row["ExtendUp"] == 1)  ? '<label class="red-type item" title="Bài hiển thị trên mục nổi bật">GHIM</label>'   : '' ?>

                                </div>
                                <div class="content-publish-info">

                                    <div class="btn-group">
                                        <button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown"
                                                class="btn btn-default btn-sm dropdown-toggle" type="button">
                                            <span class="glyphicon glyphicon-cog"></span> 
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-header"></li>
                                            <li><a href="/app90phut/news/update?id=<?= $row["ID"] ?>&urlback=<?= $param['urlback'] ?>">Chỉnh sửa</a></li>
                                            <li><a href="http://90phut.vn/tin-tuc/<?= FunctionStatic::getAlias($row["Title"]) . '-' . $row["ID"] ?>.html" target="_blank">Xem bài</a></li>
                                        </ul>
                                    </div>
                                    <div class="clearfix"/>
                                    <?php if ($row["ExtendIsPublic"]) { ?>    
                                    <span title="Đang hiển thị" style="clear: both" class="glyphicon fa fa-circle show-color"></span>
                                    <?php } else { ?>
                                    <span title="Đang ẩn" class="glyphicon hide-color fa fa-circle"></span>
                                    <?php } ?> 


                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div style="float: right">
                    <?=
                    LinkPager::widget([
                    'pagination' => $data["pagination"], 'maxButtonCount' => 10])
                    ?>   
            </div>
        </div>
    </div>
</div>