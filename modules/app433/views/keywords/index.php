<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Danh sách từ khóa trong ngày';
?>
<div class="list-item-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="col-md-8 remove-padding">
                <h3 class="panel-title">Danh sách từ khóa trong ngày</h3>
            </div>
            <div class="col-md-4 remove-padding">
                <a href="/app433/keywords/create" class="btn btn-sm btn-success pull-right dropdown-toggle">
                    <i class="glyphicon glyphicon-plus"></i>&nbsp;Tạo mới</a>
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
                        ?>
                        <tr id="listPost<?= $id; ?>">
                            <th scope="row"><?php echo $id; ?></th>
                            <td>
                                <ul class="media-list">
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="clear"></div>
                                            <div class="content">
                                                <span class="cotentArt"><?= $item['Keywords']; ?></span>
                                            </div>
                                            <div style="width: 100%;position: relative;">
                                                <span class="post-index-fullname" style="margin-top: 5px;">
                                                    <i class="fa fa-user" aria-hidden="true"></i> <?= $item['fullname']; ?> 
                                                    | <i class="fa fa-file-text-o" aria-hidden="true"></i> <?= date("H:i:s d-m-Y", strtotime($item['DateCreate'])); ?>

                                                    <br/>
                                                </span>
                                            </div>


                                        </div>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle" type="button">
                                        <span class="glyphicon glyphicon-option-horizontal"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-header"></li>
                                        <li><a href="/app433/keywords/update?id=<?= $id ?>&redirect=post"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Chỉnh sửa</a></li>
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
