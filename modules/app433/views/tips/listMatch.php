<?php
$listRole = Yii::$app->getAuthManager()->getPermissionsByUser(Yii::$app->user->getId());

use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\modules\app433\services\PostService;

$postService = new PostService();
if (isset($_REQUEST['page'])) {
    $this->title = 'Trang ' . $_REQUEST['page'] . ' - Danh sách trận đấu';
} else
    $this->title = 'Danh sách trận đấu';
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
                        <input id="Keyword" name="Keyword" class="form-control" type="text" value="<?= $keyword; ?>">
                    </div>
                    <div class="col-md-3 form-group ">
                        <label>Ngày</label>
                        <input onblur="loaddate();" onClick="loaddate();" id="datetimepicker3" name="StartDate" class="form-control hasDatepicker" type="text" value="<?= $dateTime ?>">

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
    <?php
    $leagueIdTmp = "";
    $leagueTmpInfo = '';
    $staticBongDaPlus = "http://static.bongdaplus.vn/Assets/Soccer/";
    foreach ($data as $item) {
        $img = "";
        $matchId = $item['MatchID'];
        $homeName = $item['HomeName'];
        $awayName = $item['AwayName'];
        $title = $homeName . " vs " . $awayName;
        $homeId = $item['HomeID'];
        $awayId = $item['AwayID'];
        $leagueId = $item['CompetitionID'];
        
        if ($leagueIdTmp != $leagueId) {
            if ($leagueIdTmp != "") {
                echo '</tbody></table></div></div>';
            }
            $leagueIdTmp = $leagueId;
            $leagueTmpInfo = "show";
        } else {
            $leagueTmpInfo = "hide";
        }
        $logoHome = $staticBongDaPlus . "teams/" . $homeId . ".png";
        $logoAway = $staticBongDaPlus . "teams/" . $awayId . ".png";
        $logoLeague = $staticBongDaPlus . "flags/" . $leagueId . ".png";
      
        if ($leagueTmpInfo == "show") {
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <img style="height: 16px;position: relative;top: -2px;" src="<?= $logoLeague ?>"/>
                        <?= $item['NameVN']; ?>
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table table-soccer">
                        <tbody>
                        <?php } ?>
                        <tr>
                            <td>
                                <div id="content-match-score">
                                    <label class="id">
                                        <?= date('H:i', strtotime($item['StartTime'])); ?><br/>
                                        <?= date('d-m-Y', strtotime($item['StartTime'])); ?>
                                    </label>
                                    <label class="home-name team-name"><?= $homeName; ?></label>
                                    <label class="home-name-logo">
                                        <img src="<?= $logoHome ?>">
                                    </label>
                                    <label class="score" style="position: relative">
                                        <?php
                                        if ($item['MatchState'] == 4) {
                                            echo $item['Score'];
                                        } else {
                                            echo "vs";
                                        }
                                        ?>
                                    </label>
                                    <label class="away-name-logo">
                                        <img src="<?= $logoAway ?>">
                                    </label>
                                    <label class="away-name team-name"><?= $awayName; ?></label>

                                    <?php
                                    if ($item['Description'] != null) {
                                        echo '<span class="statusTips">nđ</span>';
                                    }
                                    ?>

                                    <div class="btn-group pull-right">
                                        <button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle" type="button">
                                            <span class="glyphicon glyphicon-option-horizontal"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="/app433/tips/create?matchId=<?= $matchId; ?>" target="_blank">Nhận định</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </div>