<?php
/* @var $model app\models\bongda433\Post */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['name' => 'frmPost', 'enctype' => 'multipart/form-data']]);
$type = $model->Type;
/* IMG */
$srcThumbnails = "/img/noimg.png";
if ($model->Avatar != "") {
    $srcThumbnails = '/service/' . $model->Avatar;
}
$arrayType = [1 => 'video', 0 => 'hình ảnh'];
echo $form->field($model, 'Type')->hiddenInput(['id' => 'tyle'])->label(false);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm album <?= @$arrayType[$type] ?></h3>
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
                                    'style' => 'width:142px;'
                                    ]);
                                    ?>
                                    <?=
                                    Html::fileInput('CoverImage', '', [ 
                                      'id' => 'upload-cover',
                                    'title' => 'Chọn ảnh bìa',
                                    'accept' => 'image/*',
                                    'data-value' => 'CoverImage',
                                    'data-path' => '',
                                    'data-crop' => 'img-cover',
                                    'data-crop-width' => '580',
                                    'data-crop-height' => '326',
                                    'class' => 'images',
                                    'style' => 'width:142px;height:80px;'
                                    ])
                                    ?>
                                    <?=
                                    $form->field($model, 'Avatar')->hiddenInput([  'id' => 'CoverImage'])->label(false);
                                    ?>
                                </div>
                                <div class="media-body">
                                    <label>Chuyên mục</label>
                                    <?=
                                    $form->field($model, "CategoryID")
                                    ->dropDownList($categories, array ('class' =>  'form-control dropdownCategories'))
                                            ->label(false);
                                            ?>
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
                                <?php
                                if($postService->getRole('publish')) {
                                ?>
                                <div class="boxCheckbox pull-left">
                                    <?=
                                    $form->field($model, 'Active', array( 'template' =>  '{input}{label}<span class="textCheckBox">Hiển thị</span>'))
                            ->checkbox(array('id' => 'Active'),  false)
                            ->label("", array ('for' => 'Active', 'class' => 'label-primary'))
                            ?>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12 remove-padding">
                        <div class="frm-group">
                            <?=
                            $form->field($model, "AlbumName")->input('text', array  ('id' => 'AlbumName') )
                            ?>
                        </div>
                        <div class="frm-group">
                            <?=
                            $form->field($model, "Description")->textarea(array ('id' =>  'Description'))
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
                    if($type == 1) {
                    echo $this->render('partial/formVideo', ['listItem' => $listItem]) ;
                    } else {
                    echo $this->render('partial/formImage', ['listItem' => $listItem]) ;
                    }
                    ?>

                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12 remove-padding">
                        <div class="button-control">
                            <?= Html::input('hidden', 'redirect', 'star', ['id'  =>  'redirectFlag']);  ?>
                            <?= Html::submitButton('Xuất bản', ['onClick' => 'checkDir(1)', 'class' => 'btn btn-success']) ?>
                            <?= Html::submitButton('Xuất bản & Tiếp tục', [ 'onClick' =>  'checkDir(2)', 'class' => 'btn btn-success']) ?>
                            <?= Html::submitButton('Ðóng', [ 'onClick' => 'location.href="/app90phut/star";return false;', 'class' => 'btn btn-default']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            ActiveForm::end();
            ?>