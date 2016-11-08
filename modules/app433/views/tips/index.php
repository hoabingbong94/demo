<?php
$listRole = Yii::$app->getAuthManager()->getPermissionsByUser(Yii::$app->user->getId());

use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\modules\app433\services\PostService;

$postService = new PostService();
if (isset($_REQUEST['page'])) {
    $this->title = 'Trang ' . $_REQUEST['page'] . ' - Danh sách bài nhận định';
} else
    $this->title = 'Danh sách bài nhận định';
?>
<div class="list-item-index">
    <div class="topOption">
        <div class="remove-padding" style="width: 39%;">
            <div class="btn-group" role="group" aria-label="...">
                <a href="/app433/tips" class="btn btn-default">Tất cả</a>
                <a href="/app433/tips?public=0" class="btn btn-default">Tin ẩn</a>
            </div>
        </div>
        <!--Input tìm kiếm-->
        <div class="search">
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group">
                        <form method="get">
                            <input type="text" class="form-control" placeholder="Tìm kiếm..." name="keyword"
                                   style="width: 230px;"
                                   value="<?= isset($_GET['keyword']) ? Html::encode($_GET['keyword']) : ''; ?>"/>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">Tìm kiếm</button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-------------------->
        <div class="clearfix"></div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="col-md-8 remove-padding">
                <h3 class="panel-title">Danh sách bài nhận định</h3>
            </div>
            <div class="col-md-4 remove-padding">
                <a href="/app433/tips/list-match" class="btn btn-sm btn-success pull-right dropdown-toggle">
                    <i class="glyphicon glyphicon-list"></i>&nbsp;Danh sách trận đấu</a>
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
                    foreach ($listPost as $item) {
                        $img = $item['LOGO'];
                        $title = $item['Title'];
                        $matchId = $item['MatchID'];
                        ?>
                        <tr id="listPost<?= $matchId; ?>">
                            <th scope="row"><?php echo $matchId; ?></th>
                            <td>
                                <ul class="media-list">
                                    <li class="media">
                                        <div class="media-left">
                                            <a href="#"> 
                                                <img src="http://posts.media.profile.bongda433.com/<?= $img; ?>" data-holder-rendered="true"> 
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <div class="head">
                                                <h4 class="media-heading post-index-h4">
                                                    <?php echo $item['CategoryName'] ?>
                                                </h4>
                                                <span class="minute">
                                                    <?= date("H:i:s d-m-Y", strtotime($item['CreateDate'])); ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="content">
                                                <span class="cotentArt"><?= $title; ?></span>
                                            </div>
                                            <div style="width: 100%;position: relative;">
                                                <span class="post-index-fullname" style="margin-top: 5px;">
                                                    <i class="fa fa-user" aria-hidden="true"></i> <?= $item['fullname']; ?> 
                                                    | <i class="fa fa-file-text-o" aria-hidden="true"></i> <?= date("H:i:s d-m-Y", strtotime($item['CreateDate'])); ?>

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
                                        <li><a href="/app433/tips/update?matchId=<?= $matchId ?>&redirect=post"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Chỉnh sửa</a></li>
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
