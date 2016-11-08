<?php
/* @var $model app\modules\app433\models\Keywords */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['name' => 'frmKeywords', 'enctype' => 'multipart/form-data']]);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm từ khóa</h3>
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
            <div class="frm-group">
                <?= $form->field($model, "Keywords")->input('text', array('id' => 'Keywords')) ?>
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
                <?= Html::submitButton('Ðóng', ['onClick' => 'location.href="/app433/keywords";return false;', 'class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>
</div>
<?php
ActiveForm::end();
?>