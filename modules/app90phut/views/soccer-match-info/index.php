<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use app\services\FunctionStatic;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\app90phut\models\SoccerMatchInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Soccer Match Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soccer-match-info-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

<!--    <p>
    <?= Html::a('Create Soccer Match Info', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tìm kiếm</h3>
        </div>
        <div class="panel-body" id="panel-search">
            <form id="searchForm" action="/app90phut/soccer-match-info/" method="get">
                <div class="col-md-12 form-group ">
                    <label>Từ khóa</label>
                    <input id="Keyword" name="Keyword" class="form-control" type="text" value="<?= $param['keyword'] ?>">
                </div>

                <div class="col-md-5">
                    <div class="col-md-6 form-group ">
                        <label>Trạng thái</label>
                        <select id="State" name="State" class="selectpicker bs-select-hidden">
                            <option value="3" <?= ($param['state'] == 3) ? "selected" : "" ?>>Tất cả</option>
                            <option value="0"  <?= ($param['state'] == 0) ? "selected" : "" ?>>Đang đá</option>
                            <option value="1"  <?= ($param['state'] == 1) ? "selected" : "" ?>>Chưa đá</option>
                            <option value="2"  <?= ($param['state'] == 2) ? "selected" : "" ?>>Hoãn hủy</option>
                            <option value="4"  <?= ($param['state'] == 4) ? "selected" : "" ?>>Đá xong</option>
                        </select>
                    </div>

                    <div class="col-md-6 form-group ">
                        <label>Kiểu tìm</label>
                        <select id="Type" name="Type" class="selectpicker bs-select-hidden">
                            <option value="0" <?= ($param['type'] == 0) ? "selected" : "" ?>>Tất cả</option>
                            <option value="1" <?= ($param['type'] == 1) ? "selected" : "" ?>>Có tips</option>
                            <option value="2" <?= ($param['type'] == 2) ? "selected" : "" ?>>Không tips</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="col-md-6 form-group ">
                        <label>Từ ngày</label>
                        <input id="startdate" name="StartDate"  onblur="loaddatestart();" onclick="loaddatestart();"class="form-control hasDatepicker" type="text" value="<?= $param['start_date'] ?>">
                    </div>

                    <div class="col-md-6 form-group ">
                        <label>Đến ngày</label>

                        <input id="enddate" name="EndDate" onblur="loaddatestart();" onClick="loaddateend();" class="form-control hasDatepicker" type="text" value="<?= $param['end_date'] ?>">
                    </div>
                </div>
                <div class="col-xs-2 pull-right text-right clearfix form-group ">
                    <button class="btn btn-default" style="margin-top:24px" type="submit">Tìm Kiếm</button>
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
        $description = $item["Description"];
        $hot = $item["hot"];

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
                        <img src="<?= $logoLeague ?>">&nbsp&nbsp<?= $item['NameVN']; ?>
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table table-soccer">
                        <tbody>
                        <?php } ?>
                        <tr>
                            <td>
                                <div id="content-match-score">
                                    <label class="id"> </label>
                                    <label class="home-name team-name"><?= $homeName; ?></label>
                                    <label class="home-name-logo">
                                        <img src="<?= $logoHome ?>">
                                    </label>
                                    <label class="score">vs</label>
                                    <label class="away-name-logo">
                                        <img src="<?= $logoAway ?>">
                                    </label>
                                    <label class="away-name team-name"><?= $awayName; ?></label>
                                    <?php if ($description != null and $description != "") { ?>
                                        <label class="nd">nđ</label>
                                    <?php } ?>
                                    <?php if ($hot != null and $hot == 1) { ?>
                                        <label class="hot">Hot</label>
                                    <?php } ?>

                                    <div class="btn-group pull-right">
                                        <button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle" type="button">
                                            <span class="glyphicon glyphicon-cog"></span> 
                                            <span class="caret"></span>
                                        </button>                                                
                                        <ul class="dropdown-menu">
                                            <li><a href="/app90phut/soccer-match-info/tips/?id=<?= $matchId ?>&urlback=<?= $param['urlback'] ?>">Nhận định</a></li>
                                            <li><a  href="/app90phut/soccer-match-info/update?matchid=<?= $matchId ?>&urlback=<?= $param['urlback'] ?>">Sửa trận đấu</a></li>
                                            <?php if ($description != null and $description != "") { ?>
                                                <li><a target="_black" href="http://90phut.vn/nhan-dinh-bong-da/<?= FunctionStatic::getAlias($awayName . ' ' . $homeName) . '-' . $matchId ?>.html">Xem bài viết</a></li>
                                            <?php } ?>

                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody></table></div></div> 
</div>
<?php
// display pagination
echo LinkPager::widget([
    'pagination' => $pages,
]);
?>