<?php
/* @var $model app\modules\app90phut\models\BroadCast */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['name' => 'frmPost', 'enctype' => 'multipart/form-data']]);
//echo $form->field($model, 'ID')->hiddenInput(['id' => 'id'])->label(false);
?>
<?php if (isset($mes) && $mes != '') { ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= $mes; ?>
    </div>
<?php } ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php
            if ($action == "create") {
                echo "Thêm mới lịch truyền hình";
            } else {
                echo "Cập nhật lịch truyền hình.";
            }
            ?>
        </h3>
    </div>
    <div class="panel-body">
        <div class="col-md-12 remove-padding">
            <div class="col-md-12 remove-padding">
                <div class="frm-group col-md-6">
                    <?=
                    $form->field($model, "HomeName")->input('text', array('id' => 'HomeName'))
                    ?>
                </div>
                <div class="frm-group col-md-6">
                    <?=
                    $form->field($model, "AwayName")->input('text', array('id' => 'AwayName'))
                    ?>
                </div>
            </div>
            <div class="col-md-12 remove-padding">
                <div class="frm-group col-md-6">
                    <?=
                    $form->field($model, "Date_BroadCast")->input('text', array('id' => 'date'))
                    ?>
                </div>
                <div class="frm-group col-md-6">
                    <?=
                    $form->field($model, "Time_BroadCast")->input('text', array('id' => 'time', 'placeholder' => "__:__:__"))
                    ?>
                </div>
            </div>
            <div class="frm-group col-md-12 remove-padding">
                <?=
                $form->field($model, "Channel")->textarea(array('id' => 'Channel'))
                ?>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12 remove-padding">
            <div class="button-control">
                <?= Html::input('hidden', 'redirect', 'star', ['id' => 'redirectFlag']); ?>
                <?= Html::submitButton('Xuất bản', ['onClick' => 'checkDir(1)', 'class' => 'btn btn-success']) ?>
                <?= Html::submitButton('Xuất bản & Tiếp tục', ['onClick' => 'checkDir(2)', 'class' => 'btn btn-success']) ?>
                <?= Html::submitButton('Ðóng', ['onClick' => 'location.href="/app90phut/star";return false;', 'class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>
</div>

<?php
ActiveForm::end();
?>