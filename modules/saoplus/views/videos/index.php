<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

if (isset($_REQUEST['page'])) {
    $this->title = 'Trang ' . $_REQUEST['page'] . ' - Danh sách bài video';
} else
    $this->title = 'Danh sách bài video';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <ul class="filterPost">
                <li><a href="/saoplus/videos/index">Tất cả</a></li>
                <li><a href="/saoplus/videos/index?status=0">Tin ẩn</a></li>
            </ul>
        </div>
        <div class="col-md-8 ">
            <form class="navbar-form navbar-left pull-right" method="get" action="/saoplus/videos/index">
                <!--<div class="col-md-3 pull-left">1</div>-->
                <div class="form-group">
                    <input id="keyword" name="keyword" class="form-control" type="text" value="<?= $param['keyword'] ?>">
                </div>
                <div class="form-group ">
                    <select id="category" name="CategoriesID" class="drop-categoriesID ">
                        <option value="0" <?= ($param['CategoriesID'] == 0) ? "selected" : "" ?>>--Tất Cả--</option>
                        <?php
                        foreach ($categories as $rows) {
                            ?>
                            <option value = "<?= $rows['ID'] ?>" <?= ($param['CategoriesID'] == $rows['ID']) ? "selected" : "" ?> >
                                <?= $listPar[$rows['ID']]; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class=" btn btn-default ">Tìm kiếm</button>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="clearfix"></div>
<div class="list-item-index">
    <div class="topOption">
        <div class="clearfix"></div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="col-md-8 remove-padding">
                <h3 class="panel-title">Danh sách video</h3>
            </div>
            <div class="col-md-4 remove-padding">
                <a href="/saoplus/videos/create" class="btn btn-sm btn-success pull-right dropdown-toggle">
                    <i class="glyphicon glyphicon-plus"></i>&nbsp;Đăng video</a>
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
                    foreach ($model['data'] as $item) {
                        if ($item['Status'] == 1 || $item['Status'] == 0) {
                            $img = $item['Thumbnail'];
//                        $matchId = $item['Description'];
                            $title = $item['Title'];
                            ?>
                            <tr id="listPost<?= $item['ID']; ?>">
                                <th scope="row"><?= $item['ID']; ?><br/>
                                    <?php if ($item["Pin_Slider"] == 1) { ?>
                                    <i class="fa fa-thumb-tack ghim" title="ghim slider" aria-hidden="true"></i>
                                    <?php } ?>

                                </th>
                                <td>
                                    <ul class="media-list">
                                        <li class="media">
                                            <div class="media-left">
                                                <a href="#"> 
                                                    <img src="<?= \Yii::$app->params['media'] . $img; ?>" data-holder-rendered="true"> 
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="head">
                                                    <h4 class="media-heading post-index-h4">
                                                        <?= $title; ?>
                                                    </h4>

                                                </div>
                                                <div class="clear"></div>
                                                <div class="content">
                                                    <span class="cotentArt categoiresname"> <?= $item['CategoiresName'] ?></span>
                                                </div>
                                                <div style="width: 100%;position: relative;">
                                                    <span class="post-index-fullname" style="margin-top: 5px;">
                                                        <i class="fa fa-user" aria-hidden="true"></i> 
                                                        <?= $admin[$item['UserCreate']]; ?> 
                                                        | <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                        <?= date("H:i:s d-m-Y", strtotime($item['DateCreate'])); ?>

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
                                            <li><a href="/saoplus/videos/update?id=<?= $item['ID'] ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Chỉnh sửa</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<nav>
    <?=
    LinkPager::widget([
        'pagination' => $model["pagination"], 'maxButtonCount' => 10])
    ?>
</nav>