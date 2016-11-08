

<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Thống kê';
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="col-md-8 remove-padding">
            <h3 class="panel-title">Thống kê lượt xem</h3>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <table class="table table-style">
            <thead>
                <tr>
                    <th style="width: 50px">TT</th>
                    <th>Biên tập</th>
                    <th>Lượt xem</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $k => $v) {
                    ?>
                    <tr>
                        <td><?= ($k + 1) ?></td>
                        <td><?= $v['fullname'] ?></td>
                        <td><?= $v['totalView'] ?></td>
                    </tr>
                    <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</div>

