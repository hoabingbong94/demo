<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['name' => 'frmPost', 'enctype' => 'multipart/form-data']]);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?= $model->isNewRecord ? 'Thêm mới chuyên mục' : 'Cập nhật chuyên mục' ?></h3>
        <input type="hidden" value="<?php echo $mes; ?>"/>

    </div>

    <?php if (isset($mes) && $mes != '') { ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= $mes; ?>
        </div>
    <?php } ?>
    <div class="panel-body">
        <div class="col-md-12">
            <div class="frm-group field-CategoryName">
                <label class="control-label" for="CategoryName">Tên chuyên mục</label>
                <?= $form->field($model, "CategoryName")->input('text', array('id' => 'CategoryName'))->label(false) ?>
            </div>
            <div class="frm-group field-Parent">
                <label class="control-label" for="ParentID">Chuyên mục gốc</label>
                <?php
                $model->ParentID = $model->isNewRecord ? 0 : $model->ParentID;
                echo $form->field($model, "ParentID")->dropDownList($listParent)->label(false);
                ?>
            </div>
            <div class="frm-group field-OrderIndex">
                <label class="control-label" for="OrderIndex">Thứ tự sắp xếp</label>
                <?= $form->field($model, "OrderIndex")->input('number', array('id' => 'OrderIndex'))->label(false) ?>
            </div>
            <div class="col-md-12 remove-padding">
                <style>
                    .pull-left{width:25%;}
                </style>

                <div class="boxCheckbox pull-left">
                    <?=
                            $form->field($model, 'Public', array('template' => '{input}{label}<span class="textCheckBox">Hiển thị</span>'))
                            ->checkbox(array('id' => 'Public'), false)
                            ->label("", array('for' => 'Public', 'class' => 'label-primary'))
                    ?>
                </div>
                <!--Control--> 
                <div class="boxCheckbox pull-left">
                    <?=
                            $form->field($model, 'ShowHome', array('template' => '{input}{label}<span class="textCheckBox">Trang chủ</span>'))
                            ->checkbox(array('id' => 'ShowHome'), false)
                            ->label("", array('for' => 'ShowHome', 'class' => 'label-primary'))
                    ?>
                </div>
                <div class="boxCheckbox pull-left">
                    <?=
                            $form->field($model, 'ShowNews', array('template' => '{input}{label}<span class="textCheckBox">Trang tin</span>'))
                            ->checkbox(array('id' => 'ShowNews'), false)
                            ->label("", array('for' => 'ShowNews', 'class' => 'label-primary'))
                    ?>
                </div>
                <div class="boxCheckbox pull-left">
                    <?=
                            $form->field($model, 'ShowVideo', array('template' => '{input}{label}<span class="textCheckBox">Trang video</span>'))
                            ->checkbox(array('id' => 'ShowVideo'), false)
                            ->label("", array('for' => 'ShowVideo', 'class' => 'label-primary'))
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12 ">
            <div class="button-control">

                <?= Html::submitButton('Ðóng', ['class' => 'btn btn-default', 'onclick' => 'history.go(-1);return false;']) ?>
                <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</div>
<?php
ActiveForm::end();
?>

