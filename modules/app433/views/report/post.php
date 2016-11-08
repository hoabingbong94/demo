<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\modules\app433\services\PostService;

$postService = new PostService();
$this->title = 'Thống kê bài tin';
?>
<div class="list-item-index">
    <?= $this->render('setting', ['paramsGet' => $paramsGet, 'listAdmin' => $listAdmin]) ?>
    <div class="clearfix"></div>
    <?php
    if ($data != null) {
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Danh sách bài tin</h3>
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
                            $img = $item['Thumbnails'];
                            if ($item['Thumbnails'] == '') {
                                $img = $item['LOGO'];
                            }
                            $img = Yii::$app->params['pathMedia'] . "/" . $img;
                            $title = "";
                            if ($item['Type'] == 4) {
                                $title = $item['Title'];
                            } else {
                                $partern = '/(\[tag\])(.+?)(\[\/tag\])/';
                                $subject = $item['Content'];
                                $replacement = '<a>$2</a>';
                                $subject = preg_replace($partern, $replacement, $subject);
                                $title = $subject;
                                $title = preg_replace("/<img[^>]+\>/i", "", $title);
                                $title = preg_replace("/<iframe[^>]+\>/i", "", $title);
                            }
                            $classType = "";
                            $type = $item['Type'];
                            if ($type == 1) {
                                $classType = '<i title="Tin video" class="iconType glyphicon glyphicon-facetime-video"></i>';
                            } else if ($type == 5) {
                                $classType = '<i title="Bài Live" class="iconType iconTypeLive">LIVE</i>';
                            } else if ($type == 4) {
                                $classType = '<i title="Bài dài" class="iconType glyphicon glyphicon-text-height"></i>';
                            } else if ($type == 3) {
                                $classType = '<i title="Chùm video" class="iconType glyphicon glyphicon-film"></i>';
                            } else {
                                $classType = '<i title="Tin nhanh" class="iconType glyphicon glyphicon-align-left"></i>';
                            }
                            $classPin = '';
                            if ($item['Pin'] == 1) {
                                $classPin = ' | <i title="Tin nhanh" class="iconType">Ghim</i>';
                            }
                            $link = $item['TitleAlias'] . "/" . $id;
                            /* LInk video */
                            ?>
                            <tr id="listPost<?= $id ?>">
                                <th scope="row"><?= $id ?>
                                    <span style="width: 100%;float: left;text-align: center;">
                                        <?= $classType ?>
                                    </span>
                                </th>
                                <td>
                                    <ul class="media-list">
                                        <li class="media">
                                            <div class="media-left">
                                                <a href="#"> 
                                                    <img src="<?= $img; ?>" data-holder-rendered="true"> 
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="head">
                                                    <h4 class="media-heading post-index-h4">
                                                        <?php echo $item['CategoryName'] ?>
                                                        <input type="text" 
                                                               id="linkCopy<?= $id ?>" 
                                                               class="linkCopy" 
                                                               value="http://bongda433.com/<?= $link ?>.html"/>
                                                               <?php
                                                               if ($type == 1) {
                                                                   ?>
                                                            <input type="text" id="copyVideo<?= $id ?>" class="linkCopy" value=""/>
                                                            <?php
                                                        }
                                                        ?>
                                                    </h4>
                                                    <?php
                                                    if ($item['Recommened'] == 1) {
                                                        echo '<span class="recommened"></span>';
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?>
                                                    <span class="minute">
                                                        <?= date("d-m-Y H:i:s", strtotime($item['DateCreate'])); ?>
                                                    </span>
                                                </div>
                                                <div class="clear"></div>
                                                <div class="content">
                                                    <span class="cotentArt"><?= $title; ?></span>
                                                </div>
                                                <div style="width: 100%;position: relative;">
                                                    <span class="post-index-fullname" style="margin-top: 5px;">
                                                        Tạo bởi : <?= $item['fullname']; ?> 
                                                        | Xuất bản: <?= date("d-m-Y H:i:s", strtotime($item['DatePublic'])); ?>
                                                        <?php
                                                        if ($item['View'] != null && $item['View'] > 0) {
                                                            echo "| <i title='Lượt xem' class='iconType iconTypeLive' style='color:#449D44'>" . $item['View'] . " lượt xem</i>";
                                                        }
                                                        ?>
                                                        <?= $classPin ?>
                                                        <br/>
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }
    ?>
</div>
<nav>
    <?php
    if ($data != null) {
        echo LinkPager::widget(['pagination' => $pagination, 'maxButtonCount' => 10]);
    }
    ?>

</nav>
