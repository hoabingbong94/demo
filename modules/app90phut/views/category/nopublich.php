<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

if (isset($_REQUEST['page'])) {
    $this->title = 'Trang ' . $_REQUEST['page'] . ' - Chuyên mục tin';
} else
    $this->title = 'Chuyên mục tin';
?>

<div class="topOption">
    <div class="remove-padding" style="width: 39%;">
        <div class="btn-group" role="group" aria-label="...">
            <a href="/app90phut/category/all" class="btn btn-default">Tất cả</a>
            <a href="/app90phut/category/nopublich" class="btn btn-default">Ẩn</a>
        </div>
    </div>
    <!--Input tìm kiếm-->
    <div class="search">
        <div class="row">
            <div class="col-lg-6">
                <div class="input-group">
                    <form method="get">
                        <input type="text" class="form-control" placeholder="Tìm kiếm..." name="keyword"
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
<div class="panel panel-default" id="all">
    <div class="panel-heading">
        <div class="col-md-8 remove-padding">
            <h3 class="panel-title">Danh sách chuyên mục tin</h3>
        </div>
        <div class="col-md-4 remove-padding">
            <a href="/app90phut/category/create" class="btn btn-sm btn-success pull-right">
                <span class="glyphicon glyphicon-plus"></span>&nbsp;Thêm mới</a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <table class="table table-style">
            <thead>
                <tr>
                    <th style="width: 50px">#</th>
                    <th>Chuyên mục</th>
                    <th>Danh mục cha</th>
                    <th>Thứ tự</th>

                    <th style="width: 80px">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listCategory as $item) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $item['CategoryID']; ?></th>
                        <td>
                            <ul class="media-list">
                                <li class="media">
                                    <div class="media-body">
                                        <div class="head">
                                            <h4 class="media-heading"><?php echo $item['CategoryName'] ?></h4>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </li>
                            </ul>
                        </td>
                        <td>
                            <ul class="media-list">
                                <li class="media">

                                    <div class="media-body">
                                        <div class="head">
                                            <h4 class="media-heading"><?php echo $item['ParentID'] ?></h4>

                                        </div>
                                        <div class="clear"></div>


                                    </div>
                                </li>
                            </ul>
                        </td>
                        <td>
                            <ul class="media-list">
                                <li class="media">

                                    <div class="media-body">
                                        <div class="head">
                                            <h4 class="media-heading"><?php echo $item['OrderIndex'] ?></h4>

                                        </div>
                                        <div class="clear"></div>


                                    </div>
                                </li>
                            </ul>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown"
                                        class="btn btn-default btn-xs dropdown-toggle" type="button"><span
                                        class="glyphicon glyphicon-option-horizontal"></span></button>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-header"></li>
                                    <li><a href="app90phut/category/update?ID=<?php echo $item['CategoryID']; ?>">Chỉnh sửa</a></li>

                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
