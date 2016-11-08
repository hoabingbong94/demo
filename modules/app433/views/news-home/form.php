<?php
/* @var $model app\modules\app433\models\NewsHome */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['name' => 'frmNewsHome', 'enctype' => 'multipart/form-data']]);

/* IMG */
$srcThumbnails = "/img/noimg.png";
if ($data['Thumbnails'] != null) {
    $srcThumbnails = Yii::$app->params['pathMedia'] . $data['Thumbnails'];
}
echo $form->field($model, 'PostID')->hiddenInput(['id' => 'postId'])->label(false);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm tin trang chủ</h3>
    </div>
    <div class="panel-body">
        <?php if (isset($mes) && $mes != '') { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?= $mes; ?>
            </div>
        <?php } ?>
        <div class="col-md-8 remove-padding">
            <!--media categoriess-->
            <div class="media-list">
                <div class="media">
                    <div class="media-left">
                        <?=
                        Html::img($srcThumbnails, [
                            'id' => 'img-cover',
                            'alt' => '95x64',
                            'data-src' => 'holder.js/95x64',
                            'class' => 'media-object imgPreview image-90phut-star',
                            'data-holder-rendered' => 'true',
                            'style' => 'width:70px;height:70px'
                        ]);
                        ?>
                    </div>
                    <div class="media-body">
                        <label>Chuyên mục</label>
                        <select  class="form-control dropdownCategories">
                            <option><?= $data['CategoryName'] ?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="hrBorder" style="height:84px;"></div>
        </div>
        <div class="col-md-4 remove-padding">
            <style>
                .pull-left{width:50%;}
            </style>
            <!--Control-->
            <div class="boxCheckbox pull-left">
                <?=
                        $form->field($model, 'Status', array('template' => '{input}{label}<span class="textCheckBox">Hiển thị</span>'))
                        ->checkbox(array('id' => 'Status'), false)
                        ->label("", array('for' => 'Status', 'class' => 'label-primary'))
                ?>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12 remove-padding">
            <div class="frm-group">
                <?=
                $form->field($model, "Title")->textarea(array('id' => 'TitleNewsHome'));
                ?>
            </div>
            <div class="frm-group">
                <?=
                $form->field($model, "OrderNumber")->input('text', array('id' => 'OrderNumber'))
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
                <?= Html::submitButton('Ðóng', ['onClick' => 'location.href="/app433/news-home";return false;', 'class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>
</div>
<?php
ActiveForm::end();
?>