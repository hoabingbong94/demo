<?php
/* @var $model app\models\bongda433\MatchTips */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['name' => 'frmTips', 'name' => 'frmTips', 'enctype' => 'multipart/form-data']]);

$srcImage = $srcImageMap = "/img/noImg.png";

if ($tips->Image != null and $tips->Image != "") {
    $srcImage = \Yii::$app->params['media90phut'] . $tips->Image;
}
if ($tips->ImageMap != null and $tips->ImageMap != "") {
    $srcImageMap = \Yii::$app->params['media90phut'] . $tips->ImageMap;
}
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">

            Nhận định trận: <b><?= $match->AwayName . ' vs ' . $match->HomeName ?></b>
        </h3>
    </div>
    <div class="panel-body">
        <?php if (isset($mes) && $mes != '') { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?= $mes; ?>
            </div>
        <?php } ?>

        <?= $form->field($tips, 'MatchID')->hiddenInput()->label(false); ?>
        <div class="col-md-4">
            <div class="boxCheckbox pull-left">
                <?=
                        $form->field($tips, 'Free', array('template' => '{input}{label}<span class="textCheckBox">Xem miễn phí</span>'))
                        ->checkbox(array('id' => 'Free'), false)
                        ->label("", array('for' => 'Free', 'class' => 'label-primary'))
                ?>
            </div>
            <div class="boxCheckbox pull-left">
                <?=
                        $form->field($tips, 'Hot', array('template' => '{input}{label}<span class="textCheckBox">Bài Hot</span>'))
                        ->checkbox(array('id' => 'Hot'), false)
                        ->label("", array('for' => 'Hot', 'class' => 'label-primary'))
                ?>
            </div>

            <div class="form-group field-Free">
                <input type="checkbox" id="Pinpc" <?= ($pin) ? "checked" : "" ?> name="Pinpc" value="1">
                <label class="label-primary" for="Pinpc"></label><span class="textCheckBox">Gim Slide PC</span>
            </div>

            <div class="media-body">
                <label>Chuyên mục PC</label>

                <?=
                $form->field($tips, "Category")->dropDownList($category, array('class' => 'form-control dropdownCategories'))->label(false);
                ?>
            </div>
            <div class="clearfix"></div>
            <!--thêm vào mới-->
            <div class="media-body pull-left">
                <label>Chuyên mục 433</label>
                <?=
                $form->field($tips, "category433")->dropDownList($categories433, array('class' => 'form-control dropdownCategories'))->label(false);
                ?>
            </div>
            <div class="boxCheckbox pull-left">
                <?=
                        $form->field($tips, 'pin433', array('template' => '{input}{label}<span class="textCheckBox">Ghim 433</span>'))
                        ->checkbox(array('id' => 'pin433', 'value' => 1), false)
                        ->label("", array('for' => 'pin433', 'class' => 'label-primary'))
                ?>
            </div>
            <!--kết thúc file làm-->
        </div>
        <div class="col-md-8">
            <div class="col-md-6">
                <div class="tip-avata">
                    <label>Ảnh dại diện</label>
                    <div class="tip-avatar">
                        <?=
                        Html::img($srcImage, [
                            'id' => 'img-logo',
                            'data-src' => 'holder.js/95x64',
                            'class' => 'media-object tip-imgPreview',
                            'data-holder-rendered' => 'true',
                        ]);
                        ?>
                        <?=
                        Html::fileInput('LogoImage', '', [
                            'id' => 'upload-logo',
                            'title' => 'Chọn ảnh bìa',
                            'accept' => 'image/*',
                            'data-value' => 'LogoImage',
                            'data-path' => '',
                            'data-crop' => 'img-logo',
                            'data-crop-width' => '560',
                            'data-crop-height' => '328',
                            'class' => 'tip-images'
                        ])
                        ?>
                        <?=
                        $form->field($tips, 'Image')->hiddenInput(['id' => 'LogoImage'])->label(false);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label>Đội hình thi đấu</label>
                <div  style=" position: relative;">
                    <img id="img-image-map" src="<?= $srcImageMap ?>" style="max-width: 200px"  height="130px">
                    <?=
                    Html::fileInput('ImageMap', '', [
                        'id' => 'ImageMap',
                        'title' => 'Chọn sơ đồ trận đấu',
                        'accept' => 'image/*',
                        'data-preview' => 'img-image-map',
                        'data-path' => '',
                        'style' => 'position: absolute; top:0; left: 0; width: 100%; height: 100%; opacity: 0;',
                        'class' => 'tip-images'
                    ])
                    ?>
                </div>
            </div>     

        </div>    
        <div class="clearfix"></div>
        <div class="frm-group">
            <?= $form->field($tips, "Title")->input('text', array('id' => 'Title'))->label("Tiêu đề") ?>
        </div>
        <div class="frm-group">
            <?= $form->field($tips, "Description")->textarea(array('id' => 'Description'))->label("Mô tả"); ?>
        </div>
        <div class="frm-group postAdv">
            <div class="controlAdv">
                <img src="/img/load.gif" class="iconLoading" id="loadTip"/>
                <span class="btn btn-default btn-xs" 
                      data-tag='Tip' 
                      onClick="hastag();">
                    <i class="glyphicon glyphicon-tag"></i>
                </span>
                <span class="btn btn-default btn-xs">
                    <?= Html::fileInput('editorImg', '', ['add-image-editor' => 'Tip', 'multiple' => 'multiple']) ?>
                    <i class="glyphicon glyphicon-picture"></i>
                </span>
            </div>    
            <?= $form->field($tips, "Tips")->textarea(array('id' => 'Tip'))->label("Nội dung"); ?>

        </div>
        <div class="frm-group">
            <?= $form->field($tips, "Keyword")->input('text', array('id' => 'Keyword'))->label("Từ khóa") ?>
        </div>

        <input type="hidden" id="checkout" value="0" name="checkout">

        <div class="form-group pull-right">
            <?= Html::submitButton('Lưu lại', ['name' => 'quit', 'class' => 'btn btn-success']) ?>
            <?= Html::submitButton('Lưu lại & Tiếp tục', ['name' => 'continue', 'class' => 'btn btn-success']) ?>
            <a href="<?= $urlback ?>" style="margin-left:20px" class="btn btn-default" >Thoát</a>
        </div> 
    </div>
</div>
<?php ActiveForm::end(); ?>


<script>

    function setcheckout() {
//        alert(1);
        $('#checkout').val(1);
        document.getElementById("frmTips").submit();
    }
    var config_simple = {
        toolbar: [
            {name: 'colors', items: ['Source']},
            {
                name: 'basicstyles',
                groups: ['basicstyles', 'cleanup'],
                items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat']
            },
        ],
        height: 70,
    };
    CKEDITOR.replace('Description', config_simple);
</script>
<script>
    var config_tip = {
//        extraPlugins:'smiley',
        toolbar: [
            {name: 'colors', items: ['Source']},
            {
                name: 'basicstyles',
                groups: ['basicstyles', 'cleanup'],
                items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat']
            },
            {
                name: 'clipboard',
                groups: ['clipboard', 'undo'],
                items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
            },
            {name: 'insert', items: ['Table', 'Image', 'Smiley']},
            '/',
            {name: 'styles', items: ['Format']},
            {name: 'tools', items: ['Maximize']},
            {
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
            },
            {name: 'links', items: ['Link', 'Unlink']},
            {name: 'colors'}
        ],
        smiley_images: ['match_action_1.png', 'match_action_2.png', 'match_action_3.png', 'match_action_5.png', 'match_action_6.png', 'match_action_7.png', 'match_action_8.png', 'match_action_11.png', 'match_action_14.png', 'ti_le.png', 'the_vang.png', 'the_do.png', 'kick_off.png', 'pen.png', 'phat_goc.png', 'ban_thang.png', 'thay_nguoi.png', 'doihinh_rasan.png'],
        smiley_descriptions: ['Sút vào', 'Thẻ vàng', 'Thẻ vàng thứ 2', 'Ra sân', 'Vào sân', 'Thẻ đỏ', '11m không vào', '11m vào', 'Sút phạt vào', 'Kiến tạo', 'Tỉ lệ', 'Thẻ vàng', 'Thẻ đỏ', 'Kick off', 'Penaty', 'Phạt góc', 'Bàn thắng', 'Thay người', 'Đội hình ra sân'],
        height: 500,
    };

    CKEDITOR.replace('Tip', config_tip);
</script>
