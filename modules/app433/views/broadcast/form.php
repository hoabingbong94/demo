<?php
/* @var $model app\modules\app433\models\Broadcast */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\app433\services\BroadcastService;

$broadcastService = new BroadcastService();
$form = ActiveForm::begin(['options' => ['name' => 'frmBroadcast', 'enctype' => 'multipart/form-data']]);
$homeName = $awayName = "";
$homeLogo = $awayLogo = "";
$thumb = "";
if ($model->ID != '') {
    $listTeamId[0] = $model->HomeId;
    $listTeamId[1] = $model->AwayId;
    $listTeam = $broadcastService->getListTeamById($listTeamId);
    $homeName = $listTeam[$model->HomeId]['TeamName'];
    $homeLogo = "http://static.bongdaplus.vn/Assets/Soccer/" . $listTeam[$model->HomeId]['Logo'];
    $awayName = $listTeam[$model->AwayId]['TeamName'];
    $awayLogo = "http://static.bongdaplus.vn/Assets/Soccer/" . $listTeam[$model->AwayId]['Logo'];
    $thumb = Yii::$app->params['pathMedia'] . $model->Avatar;
}
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm từ lịch truyền hình</h3>
    </div>
    <div class="panel-body">
        <div class="col-md-12 remove-padding">
            <div class="frm-group" style="margin-bottom: 0px;">
                <div class="boxCheckbox pull-left">
                    <?=
                            $form->field($model, 'Status', array('template' => '{input}{label}<span class="textCheckBox">Hiển thị</span>'))
                            ->checkbox(array('id' => 'Status'), false)
                            ->label("", array('for' => 'Status', 'class' => 'label-primary'))
                    ?>
                </div>
            </div>
            <div class="frm-group" style="width:100%;float:left;">
                <div class="col-md-8">
                    <div class="frm-group col-md-12 remove-padding">
                        <label>Ảnh đại diện</label>
                        <div class="post-avatar">
                            <?=
                            Html::img($thumb, [
                                'id' => 'img-cover-facebook',
                                'alt' => '',
                                'data-src' => 'holder.js/125x80',
                                'class' => 'media-object media-object-avatar',
                                'data-holder-rendered' => 'true',
                                'style' => 'width:270px'
                            ]);
                            ?>
                            <?=
                            Html::fileInput('CoverImageFacebook', '', [
                                'id' => 'upload-cover-facebook',
                                'title' => 'Chọn ảnh bìa',
                                'accept' => 'image/*',
                                'data-value' => 'imageShareFacebook',
                                'data-path' => '',
                                'data-crop' => 'img-cover-facebook',
                                'data-crop-width' => '550',
                                'data-crop-height' => '210',
                                'class' => 'images inputFile',
                                'style' => 'left:279px !important'
                            ])
                            ?>
                            <span class="btn btn-default">Chọn ảnh</span>
                        </div>
                        <?=
                        $form->field($model, 'Avatar')->hiddenInput(['id' => 'imageShareFacebook'])->label(false);
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php
                    echo $form->field($model, "CategoriesID")
                            ->dropDownList($categories, array('class' => 'form-control dropdownCategories'))
                            ->label("Chuyên mục");
                    ?>
                </div>
            </div>
            <div class = "frm-group">
                <div style = "width:50%;float:left;">
                    <label>Đội nhà</label>
                    <div class = "box-team">
                        <div style="background: <?= $model->AwayColor ?>" class = "logoTeam" id = "color-teamHome"><img id = "imghomeTeam" src = "<?= $homeLogo ?>"/></div>
                        <div class = "search-team">
                            <input autocomplete="off"  value="<?= $homeName ?>" onkeydown = "searchTeam('homeTeam')" type = "text" name = "homeTeam" id = "homeTeam"/>
                            <ul id = "data-searchhomeTeam">
                            </ul>
                        </div>
                        <div class = "team-color">
                            <input type = "color" name = "colorTeamHome" id = "colorTeamHome"/>
                            <button id = "colorTeamHomeBtn"><i class = "fa fa-adjust" aria-hidden = "true"></i></button>
                        </div>
                    </div>
                    <div class = "clearfix"></div>
                    <?= $form->field($model, "HomeId")->input('hidden', array('id' => 'inputIdhomeTeam'))->label(false)
                    ?>
                    <?= $form->field($model, "HomeColor")->input('hidden', array('id' => 'inputColorhomeTeam'))->label(false) ?>
                </div>
                <div style="width:48%;float:right;">
                    <label>Đội khách</label>
                    <div class="box-team">
                        <div class="logoTeam" style="background: <?= $model->AwayColor ?>" id="color-teamAway"><img id="imgawayTeam" src="<?= $awayLogo ?>"/></div>
                        <div class="search-team">
                            <input autocomplete="off" value="<?= $awayName ?>" onkeydown="searchTeam('awayTeam')" type="text" name="awayTeam" id="awayTeam"/>
                            <ul id="data-searchawayTeam">
                            </ul>
                        </div>
                        <div class="team-color">
                            <input type="color" name="colorTeamAway" id="colorTeamAway"/>
                            <button id="colorTeamAwayBtn"><i class="fa fa-adjust" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?= $form->field($model, "AwayId")->input('hidden', array('id' => 'inputIdawayTeam'))->label(false) ?>
                    <?= $form->field($model, "AwayColor")->input('hidden', array('id' => 'inputColorawayTeam'))->label(false) ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="frm-group">
                <?php
                echo $form->field($model, 'StartTime', ['template' => '{label}<div class="input-group date" onClick="loaddatetime();" id="datetimepicker2">{input}<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div>'])
                        ->input('text', ['class' => 'form-control'])->label("Phát sóng lúc");
                ?>
            </div>
            <div class="frm-group">
                <?= $form->field($model, "Channel")->input('text', array('id' => 'Channel')) ?>
            </div>
            <div class="frm-group">
                <?= $form->field($model, "Sopcast")->textarea(array('id' => 'Sopcast')) ?>
                <script>
                    CKEDITOR.replace('Sopcast');
                </script>
            </div>

        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="frm-group">
            <div class="boxCheckbox pull-left">
                <?=
                        $form->field($model, 'LiveStream', array('template' => '{input}{label}<span class="textCheckBox">LiveStream</span>'))
                        ->checkbox(array('id' => 'LiveStream'), false)
                        ->label("", array('for' => 'LiveStream', 'class' => 'label-primary'))
                ?>
            </div>
            <div class = "clearfix"></div>
            <div class="frm-group">
                <?= $form->field($model, "LiveStreamLink")->input('text', array('id' => 'LiveStreamLink')) ?>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12 remove-padding">
            <div class="button-control">
                <?= Html::input('hidden', 'redirect', 'post', ['id' => 'redirectFlag']); ?>
                <?= Html::submitButton('Xuất bản', ['onClick' => 'checkDir(1)', 'class' => 'btn btn-success']) ?>
                <?= Html::submitButton('Ðóng', ['onClick' => 'location.href="/app433/broadcast";return false;', 'class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>
</div>
<?php
ActiveForm::end();
?>