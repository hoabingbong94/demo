<?php
$listRole = Yii::$app->getAuthManager()->getPermissionsByUser(Yii::$app->user->getId());

use yii\helpers\Html;
use yii\widgets\LinkPager;

if (isset($_REQUEST['page'])) {
    $this->title = 'Trang ' . $_REQUEST['page'] . ' - Danh sách bài tin 90phut';
} else
    $this->title = 'Danh sách bài tin 90phut';
?>
<div class="list-item-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tìm kiếm</h3>
        </div>
        <div class="panel-body" id="panel-search">
            <form id="searchForm" action="" method="get">
                <div class="col-md-12">
                    <div class="col-md-7 form-group ">
                        <label>Từ khóa</label>
                        <input id="Keyword" name="Keyword" class="form-control" type="text" value="">
                    </div>
                    <div class="col-md-3 form-group ">
                        <label>Ngày</label>
                        <input onblur="loaddate();" onClick="loaddate();" id="datetimepicker3" name="StartDate" class="form-control hasDatepicker" type="text" value="">

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
                <h3 class="panel-title">Danh sách bài tin 90phut</h3>
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
                        $img = $item['Thumbnails'];
                        $title = $item['Summary'];
                        ?>
                        <tr id="listPost<?= $id ?>">
                            <th scope="row"><?= $id ?></th>
                            <td>
                                <ul class="media-list">
                                    <li class="media">
                                        <div class="media-left">
                                            <a href="#"> 
                                                <img src="http://90phut.vn/service/<?= $img; ?>" data-holder-rendered="true"> 
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <div class="head">
                                                <h4 class="media-heading post-index-h4">
    <?php echo $item['Title'] ?>
                                                </h4>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="content">
                                                <span class="cotentArt"><?= $title; ?></span>
                                            </div>
                                            <div style="width: 100%;position: relative;">
                                                <span class="post-index-fullname" style="margin-top: 5px;">
                                                    <i class="fa fa-user" aria-hidden="true"></i> <?= $item['FullName']; ?> 
                                                    | <i class="fa fa-file-text-o" aria-hidden="true"></i> <?= date("d-m-Y H:i:s", strtotime($item['ExtendUpdateDate'])); ?>
                                                    <br/>
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button aria-expanded="false" 
                                            aria-haspopup="true" 
                                            data-toggle="dropdown" 
                                            class="btn btn-default btn-xs dropdown-toggle" 
                                            type="button">
                                        <span class="glyphicon glyphicon-option-horizontal"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-header"></li>
                                        <li><a href="/app433/post/create?newsId=<?php echo $id ?>&redirect=90phut&type=4">Đăng tin</a></li>
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
