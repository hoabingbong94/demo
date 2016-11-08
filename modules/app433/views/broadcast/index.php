<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Lịch truyền hình';
?>
<div class="list-item-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tìm kiếm</h3>
        </div>
        <div class="panel-body" id="panel-search">
            <form id="searchForm" action="" method="get">
                <div class="col-md-12">
                    <div class="col-md-5 form-group ">
                        <label>Ngày</label>
                        <input onblur="loaddate();" onClick="loaddate();" id="datetimepicker3" name="date" class="form-control hasDatepicker" type="text" value="<?= $date ?>">
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Trạng thái</label>
                        <select name="status" class="form-control">
                            <?php
                            $listState = [3 => 'Tất cả', 0 => 'Ẩn', 1 => 'Hiển thị'];
                            foreach ($listState as $k => $v) {
                                $selected = "";
                                if ($k == $status) {
                                    $selected = "selected";
                                }
                                echo '<option ' . $selected . ' value="' . $k . '">' . $v . '</option>';
                            }
                            ?>
                        </select>
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
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="col-md-8 remove-padding">
                <h3 class="panel-title">Lịch truyền hình ngày <?= date("d-m-Y", strtotime($date)) ?></h3>
            </div>
            <div class="col-md-4 remove-padding">
                <a href="/app433/broadcast/create" class="btn btn-sm btn-success pull-right dropdown-toggle">
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
                        $channel = $item['Channel'];
                        $id = $item['ID'];
                        $homeName = $listTeam[$item['HomeId']]['TeamName'];
                        $awayName = $listTeam[$item['AwayId']]['TeamName'];
                        ?>
                        <tr id="listPost<?= $id; ?>">
                            <th scope="row"><?php echo $id; ?></th>
                            <td>
                                <ul class="media-list">
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="head">
                                                <h4 class="media-heading post-index-h4">
                                                    <?= $homeName . " vs " . $awayName ?>
                                                </h4>
                                                <span class="minute">
                                                    <?= date("H:i:s d-m-Y", strtotime($item['StartTime'])); ?>
                                                </span>
                                            </div>
                                            <div class="content">
                                                <span class="cotentArt"><?= $channel; ?></span>
                                            </div>
                                            <div style="width: 100%;position: relative;">
                                                <span class="post-index-fullname" style="margin-top: 5px;">
                                                    Tạo bởi : <?= $item['fullname']; ?> 
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
                                    <button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle" type="button">
                                        <span class="glyphicon glyphicon-option-horizontal"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-header"></li>
                                        <li><a href="/app433/broadcast/update?id=<?= $id ?>&redirect=post"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Chỉnh sửa</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>
            <!--            <div class="broadcast-header">
                            <h4>Lịch truyền hình ngày 09-08-2016</h4>
                        </div>
                        <div class="broadcast-list">
                            <ul>
                                <li>
                                    <div class="boxLeft" style="background:#CCC">
                                        <img src="http://static.bongdaplus.vn/Assets/Soccer/teams/660.png"/>
                                    </div>
                                    <div class="boxCenter">
                                        <div class="teamName HomeName">Arsenal</div>
                                        <div class="score">0 - 0</div>
                                        <div class="teamName AwayName">Chelsea</div>
                                    </div>
                                    <div class="boxRight" style="background: #DDD">
                                        <img src="http://static.bongdaplus.vn/Assets/Soccer/teams/661.png"/>
                                    </div>
                                </li>
                            </ul>
                        </div>-->
        </div>
    </div>
</div>
