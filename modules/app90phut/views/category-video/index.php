<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Chuyên mục video';
?>


<div class="panel panel-default" id="index">
    <div class="panel-heading">
        <div class="col-md-8 remove-padding">
            <h3 class="panel-title">Danh sách chuyên mục video</h3>
        </div>

        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <table class="table table-style">
            <thead>
                <tr>
                    <th style="width: 50px">ID</th>
                    <th>Chuyên mục</th>
                    <th>Mã giải</th>
                    <th>Thứ tự</th>
                    <th style="width: 90px">Hiển thị</th>

                    <th style="width: 30px">#</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listCategory as $item) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $item['ID']; ?></th>
                        <td>
                            <ul class="media-list">
                                <li class="media">
                                    <div class="media-body">
                                        <div class="head">
                                            <h4 class="media-heading"><?php echo $item['Name'] ?></h4>
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
                                            <h4 class="media-heading"><?php echo $item['LeagueID'] ?></h4>

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
                                            <h4 class="media-heading"><?php echo $item['OrderNumber'] ?></h4>

                                        </div>
                                        <div class="clear"></div>


                                    </div>
                                </li>
                            </ul>
                        </td>
                        <td>
                            <?php if ($item['Active']) { ?>
                                <span class="glyphicon fa fa-circle show-color" title="Đang hiển thị"></span>
                            <?php } else { ?>
                                <span class="glyphicon fa fa-circle hide-color" title="Đang ẩn"></span>
                            <?php } ?>
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
                                    <li><a href="category-video/update?id=<?php echo $item['ID']; ?>">Chỉnh sửa</a></li>

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
