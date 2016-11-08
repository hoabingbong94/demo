<?php
$listRole = Yii::$app->getAuthManager()->getPermissionsByUser(Yii::$app->user->getId());

use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\modules\app433\services\GetNewsTTVNService;

$ttvnService = new GetNewsTTVNService();
if (isset($_REQUEST['page'])) {
    $this->title = 'Trang ' . $_REQUEST['page'] . ' - Danh sách bài tin thể thao việt nam';
} else
    $this->title = 'Danh sách bài tin thể thao việt nam';
?>
<div class="list-item-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="col-md-8 remove-padding">
                <h3 class="panel-title">Danh sách bài tin thể thao việt nam</h3>
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
                        $img = $item['Thumb'];
                        $title = $item['Description'];
                        $classType = '<i title="Tin video" class="iconType glyphicon glyphicon-facetime-video"></i>';
                        if ($item['Type'] == 1) {
                            $classType = '<i title="Bài dài" class="iconType glyphicon glyphicon-text-height"></i>';
                        }
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
                                                <img width="60" src="<?= $img; ?>" data-holder-rendered="true"> 
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
                                                    <i class="fa fa-file-text-o" aria-hidden="true"></i> <?= $ttvnService->getCategries($item['Categories']) ?>
                                                    | <i class="fa fa-clock-o" aria-hidden="true"></i> <?= date("d-m-Y H:i:s", strtotime($item['DateCreate'])); ?>
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
                                            <?php
                                            if ($item['Type'] == 1) {
                                                ?>
                                            <li><a href="/app433/post/create?ttvnId=<?php echo $id ?>&redirect=ttvn&type=4">Đăng tin</a></li>
                                            <?php
                                        } else {
                                            ?>
                                            <li><a href="/app433/post/create?ttvnId=<?php echo $id ?>&redirect=ttvn&type=1">Đăng tin</a></li>
                                            <?php
                                        }
                                        ?>
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
