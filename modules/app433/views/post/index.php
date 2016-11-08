<?php
$listRole = Yii::$app->getAuthManager()->getPermissionsByUser(Yii::$app->user->getId());

use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\modules\app433\services\PostService;

$postService = new PostService();

if (isset($_REQUEST['page'])) {
    $this->title = 'Trang ' . $_REQUEST['page'] . ' - Danh sách bài post';
} else
    $this->title = 'Danh sách bài post';
?>
<div class="list-item-index">
    <div class="topOption">
        <div class="remove-padding" style="width: 43%;">
            <ul class="filterPost">
                <li><a href="/app433/post">Tất cả</a></li>
                <li><a href="/app433/post?type=4">Tin dài</a></li>
                <li><a href="/app433/post?type=1">Tin Video</a></li>
                <li><a onClick="searchAdv();" id="showBoxSearchPlus"><i class="fa fa-search" aria-hidden="true"></i> +</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-option-horizontal"></i></a>
                    <ul>
                        <li><a href="/app433/post?type=5">Bài Live</a></li>
                        <li><a href="/app433/post?type=6">Live stream</a></li>
                        <li><a href="/app433/post?type=0">Tin nhanh</a></li>
                        <li><a href="/app433/post?type=3">Chùm Video</a></li>
                        <li><a href="/app433/post?datePost=off">Chờ xuất bản</a></li>
                        <li><a href="/app433/post?public=0">Tin Ẩn</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!--Input tìm kiếm-->
        <div class="search">
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group">
                        <form method="get">
                            <input type="text" 
                                   class="form-control" 
                                   placeholder="Tìm kiếm..." 
                                   name="keyword"
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
    <div class="clearfix"></div>
    <?= $this->render('partial/searchAdv')?>
    <div class="clearfix"></div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="col-md-8 remove-padding">
                <h3 class="panel-title"><i class="fa fa-bars" aria-hidden="true"></i> Danh sách bài tin</h3>
            </div>
            <div class="col-md-4 remove-padding">
                <div class="btn-group" style="float:right;">
                    <button onClick="popupChoiceTypeAdd();" 
                            type="button" 
                            class="btn btn-sm btn-success">
                        <i class="glyphicon glyphicon-plus"></i>&nbsp;Đăng tin
                    </button>
                    <button type="button" 
                            class="btn btn-sm btn-success dropdown-toggle" 
                            data-toggle="dropdown" 
                            aria-haspopup="true" 
                            aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="/app433/post/list-news">Bài tin 90phut</a></li>
                        <li><a href="/app433/post/list-star">Người đẹp 90phut</a></li>
                        <li><a href="/app433/get-news/list-all">Tin thể thao việt nam</a></li>
                            <?php
                        if (isset($listRole['Admin'])) {
                            ?>
                            <li><a href="/app433/news-home">Tin nổi bật</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="modal fade in" 
                     id="modal-add-post" 
                     tabindex="-1" 
                     role="dialog" 
                     aria-labelledby="Modle_Video_HighlightLable">
                    <div class="modal-dialog" role="document"style="width: 330px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" 
                                        class="close" 
                                        data-dismiss="modal" 
                                        aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h4 style="font-size: 16px;" class="modal-title">Chọn kiểu tin</h4>
                            </div>
                            <div class="modal-body">
                                <div class="list-group" style="width: 300px;margin: 0 auto">
                                    <a class="list-group-item" href="/app433/post/create?type=0">Tin Nhanh
                                        <i class="glyphicon glyphicon-chevron-right pull-right"></i>
                                    </a>
                                    <a class="list-group-item" href="/app433/post/create?type=4">Tin dài
                                        <i class="glyphicon glyphicon-chevron-right pull-right"></i>
                                    </a>
                                    <a class="list-group-item" href="/app433/post/create?type=1">Video
                                        <i class="glyphicon glyphicon-chevron-right pull-right"></i>
                                    </a>
                                    <a class="list-group-item" href="/app433/post/create?type=3">Album Video
                                        <i class="glyphicon glyphicon-chevron-right pull-right"></i>
                                    </a>
                                    <a class="list-group-item" href="/app433/post/create?type=5">Bài live
                                        <i class="glyphicon glyphicon-chevron-right pull-right"></i>
                                    </a>
                                    <a class="list-group-item" href="/app433/post/create?type=6">Live stream
                                        <i class="glyphicon glyphicon-chevron-right pull-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                        } else if ($type == 6) {
                            $classType = '<i title="Live stream" class="iconType fa fa-rss iconTypeLive"></i>';
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
                                                    <?= date("H:i:s d-m-Y", strtotime($item['DateCreate'])); ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="content">
                                                <span class="cotentArt"><?= $title; ?></span>
                                            </div>
                                            <div style="width: 100%;position: relative;">
                                                <span class="post-index-fullname" style="margin-top: 5px;">
                                                    <i class="fa fa-user" aria-hidden="true"></i> <?= $item['fullname']; ?> 
                                                    | <i class="fa fa-file-text-o" aria-hidden="true"></i> <?= date("H:i:s d-m-Y", strtotime($item['DatePublic'])); ?>
                                                    <?php
                                                    if ($item['View'] != null && $item['View'] > 0) {
                                                        echo "| <i title='Lượt xem' class='iconType iconTypeLive' style='color:#449D44'><i class='fa fa-eye' aria-hidden='true'></i> " . $item['View'] . "</i>";
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
                            <td>
                                <div class="btn-group">
                                    <button aria-expanded="false" 
                                            aria-haspopup="true" 
                                            data-toggle="dropdown" 
                                            class="btn btn-default btn-xs dropdown-toggle" 
                                            type="button">
                                        <span class="glyphicon glyphicon-option-horizontal"></span>
                                    </button>
                                    <ul class="dropdown-menu" id="dropdown<?= $id ?>">
                                        <li class="dropdown-header"></li>
                                        <?php
                                        if ($type == 5) {
                                            ?>
                                            <li><a href="/app433/post/update-live?postId=<?= $id ?>"><i class="fa fa-rss" aria-hidden="true"></i> Tường thuật</a></li>
                                            <?php
                                        }
                                        ?>
                                        <li><a href="/app433/post/update?postId=<?php echo $id ?>&redirect=post"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Chỉnh sửa</a></li>
                                        <li><a href="javascript:void(0);" onClick="copyfieldvalue(<?= $id ?>);"><i class="fa fa-link" aria-hidden="true"></i> Copy Link</a></li>
                                        <li><a href="/app433/post/view-log?id=<?= $id ?>"><i class="fa fa-history" aria-hidden="true"></i> Xem lịch sử</a></li>
                                        <?php
                                        if (isset($listRole['Admin'])) {
                                            if ($type != 1 && $type != 3) {
                                                ?>
                                                <li><a href="/app433/news-home/create?postId=<?= $id ?>"><i class="fa fa-star-o" aria-hidden="true"></i> Chọn tin nổi bật</a></li>
                                                <?php
                                            }
                                            ?>
                                            <li><a href="javascript:void(0);" onClick="deletePost(<?= $id ?>);"><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</a></li>
                                            <?php
                                        }

                                        if ($type == 1) {
                                            ?>
                                            <li class="dropdown-submenu">
                                                <a class="test" href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i> Copy Video 
                                                    <span class="caret"></span>
                                                </a>
                                                <?php
                                                echo $this->render('partial/copyLinkVideo', [
                                                    'id' => $id,
                                                    'thumbVideo' => $item['ThumbVideo'],
                                                    'videoRoot' => $item['UrlVideo'],
                                                    'video480p' => $item['UrlVideo480p'],
                                                    'video360p' => $item['UrlVideo360p'],
                                                    'video240p' => $item['UrlVideo240p']])
                                                ?>
                                            </li>
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
