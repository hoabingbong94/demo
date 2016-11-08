
<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\modules\app433\services\PostService;

$postService = new PostService();
$this->title = 'Thống kê tổng số bài';
?>
<div class="list-item-index">
    <?= $this->render('setting', ['paramsGet' => $paramsGet, 'listAdmin' => $listAdmin]) ?>
    <div class="clearfix"></div>
    <?php
    if ($data != null) {
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Bảng thống kê</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>TT</th>
                            <?php
                            if ($paramsGet['userCreate'] != "") {
                                echo "<th>Thời gian</th>";
                            } else {
                                echo "<th>Biên tập</th>";
                            }
                            ?>
                            <th>Tổng bài</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $k => $v) {
                            $data = $v['fullname'];
                            if ($paramsGet['userCreate'] != "") {
                                $data = date("d-m-Y", strtotime($v['DateCreate']));
                            }
                            echo '<tr>
                            <td>' . ($k + 1) . '</td>
                            <td>' . $data . '</td>
                            <td>' . $v['total'] . '</td>
                        </tr>';
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }
    ?>
</div>
