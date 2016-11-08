<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Chuyên mục pc';
?>
<div class="list-item-index">
    <div class="topOption">
        <div class="remove-padding" style="width: 39%;">
            <ul class="filterPost">
                <li><a href="/app90phut/categories-pc">Tất cả</a></li>
                <li><a href="/app90phut/categories-pc?public=0">Chuyên mục ẩn</a></li>
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
    <div class="panel panel-default" id="index">
        <div class="panel-heading">
            <div class="col-md-8 remove-padding">
                <h3 class="panel-title">Danh sách chuyên mục PC</h3>
            </div>
            <div class="col-md-4 remove-padding">
                <a href="/app90phut/categories-pc/create" class="btn btn-sm btn-success pull-right">
                    <span class="glyphicon glyphicon-plus"></span>&nbsp;Thêm mới</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <table class="table table-style">
                <thead>
                    <tr>
                        <th style="width: 50px">ID</th>
                        <th>Tên chuyên mục</th>
                        <th>Chuyên mục cha</th>
                        <th>Thứ tự</th>
                        <th style="width: 30px">#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $all = array();
                    foreach ($data as $k => $v) {
                        $all[$v['ID']] = $v['CategoryName'];
                    }
                    foreach ($data as $item) {
                        ?>
                        <tr>
                            <th scope="row"><?= $item['ID'] ?></th>
                            <td>
                                <?php echo $item['CategoryName'] ?>
                            </td>
                            <td>
                                <?= isset($all[$item['ParentID']]) ? $all[$item['ParentID']] : "[Chuyên mục gốc]" ?>
                            </td>
                            <td>
                                <?php echo $item['OrderIndex'] ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown"
                                            class="btn btn-default btn-xs dropdown-toggle" type="button"><span
                                            class="glyphicon glyphicon-option-horizontal"></span></button>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-header"></li>
                                        <li><a href="/app90phut/categories-pc/update?id=<?php echo $item['ID']; ?>">Chỉnh sửa</a></li>

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
<style>
    .iconPublic{
        width: 100%;
        float: left;
        text-align:center;
    }
    .iconPublic i{
        width: 10px;
        height:10px;
        float:left;
        background: #52BB5D;
        border-radius: 50%;
    }
    .iconPublic i[data-value='0']{
        background: #cccccc;
    }
</style>