<?php
$listRole = Yii::$app->getAuthManager()->getPermissionsByUser(Yii::$app->user->getId());

use yii\helpers\Html;
use yii\widgets\LinkPager;

if (isset($_REQUEST['page'])) {
    $this->title = 'Trang ' . $_REQUEST['page'] . ' - Danh sách banner';
} else
    $this->title = 'Danh sách banner';
?>
<div class="list-item-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="col-md-8 remove-padding">
                <h3 class="panel-title">Danh sách banner</h3>
            </div>
            <div class="col-md-4 remove-padding">
                <a href="/app433/banner/create" class="btn btn-sm btn-success pull-right dropdown-toggle">
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
                    foreach ($listBanner as $item) {
                        $img = $item['Images'];
                        $title = $item['Title'];
                        $id = $item['ID'];
                        ?>
                        <tr id="listPost<?= $id; ?>">
                            <th scope="row"><?php echo $id; ?></th>
                            <td>
                                <ul class="media-list">
                                    <li class="media">
                                        <div class="media-left">
                                            <a href="#"> 
                                                <img src="http://posts.media.profile.bongda433.com/<?= $img; ?>" data-holder-rendered="true"> 
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <div class="content">
                                                <span class="cotentArt"><?= $title; ?></span>
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
                                        <li><a href="/app433/banner/update?id=<?= $id ?>&redirect=post">Chỉnh sửa</a></li>
                                        <li><a href="/app433/banner/delete?id=<?= $id ?>">Xóa</a></li>
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
<nav>
    <?=
    LinkPager::widget([
        'pagination' => $pagination, 'maxButtonCount' => 10])
    ?>

</nav>
