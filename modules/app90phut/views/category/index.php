<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Chuyên mục tin';
?>


<div class="panel panel-default" id="index">
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
                    <th style="width: 50px">ID</th>
                    <th>Chuyên mục</th>
                    <th>Danh mục cha</th>
                    <th>Thứ tự</th>

                    <th style="width: 30px">#</th>
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
                                        class="btn btn-default btn-sm dropdown-toggle" type="button">
                                    <span class="glyphicon glyphicon-cog"></span> 
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-header"></li>
                                    <li><a href="category/update?id=<?php echo $item['CategoryID']; ?>">Chỉnh sửa</a></li>

                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<nav>



</nav>
