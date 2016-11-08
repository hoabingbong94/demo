

<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Thống kê';
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="col-md-8 remove-padding">
            <h3 class="panel-title">Thống kê</h3>
        </div>
        <div class="col-md-4 remove-padding">
            <a href="/app90phut/report/export-excel?data=<?= $json ?>&params=<?= $params ?>" class="btn btn-sm btn-success pull-right dropdown-toggle">
                <i class="glyphicon glyphicon-open"></i>&nbsp;Xuất Excel</a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <table class="table table-style">
            <thead>
                <tr>
                    <th style="width: 50px">TT</th>
                        <?php
                        if ($userId == "") {
                            ?>
                        <th>Biên tập</th>
                        <?php
                    } else {
                        ?>
                        <th>Ngày thống kê</th>
                        <?php
                    }
                    ?>
                    <th width="100">Tổng bài</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $k => $v) {
                    ?>
                    <tr>
                        <td><?= ($k + 1) ?></td>
                        <?php
                        if ($userId == "") {
                            ?>
                            <td><?= $v['fullname'] ?></td>
                        <?php } else { ?>
                            <td><?= $v['dateCreate'] ?></td>
                            <?php
                        }
                        ?>
                        <td><?= $v['total'] ?></td>
                    </tr>
                    <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</div>

