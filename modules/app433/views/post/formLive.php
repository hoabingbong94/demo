<?php

use yii\helpers\Html;
use app\modules\app433\services\LiveService;

$liveService = new LiveService();
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Tường thuật trận đấu</h3>
        <button class="btnAddvent btn btn-success btn-sm " 
                onClick="addEvent();">
            <i class="glyphicon glyphicon-plus"></i> Tạo mới
            <input type="hidden" value="<?= $postId ?>" name="postId" id="postId"/>
        </button>
    </div>
    <div class="panel-body">
        <!--Flag hidden-->

        <!--Flag hidden-->
        <div class="col-md-12 remove-padding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="20" >TT</th>
                        <th width="20" >Phút</th>
                        <th width="70">Sự kiện</th>
                        <th>Nội dung</th>
                        <th width="100">#</th>
                    </tr>
                </thead>
                <tbody id="reloadLive">
                    <?php
                    foreach ($data as $k => $v) {
                        $id = $v['ID'];
                        $pathMedia = Yii::$app->params['pathMedia'] . $v['UrlVideo'];
                        $type = $v['Type'];
                        $minute = $v['Minute'];
                        $content = $v['Content'];
                        $postId = $v['PostID'];
                        ?>
                        <tr id="live<?= $id ?>">
                            <td class="event-minute"><?= $v['Order'] ?></td>
                            <td class="event-minute"><?= $minute ?></td>
                            <td><i class="iconEvent" data-event="<?= $type ?>"></i></td>
                            <td><?= $content ?></td>
                            <td>
                                <input type="hidden" id="tmpValue<?= $id ?>"

                                       data-minute="<?= $minute ?>"
                                       data-type="<?= $type ?>"
                                       data-media="<?= $pathMedia ?>"
                                       data-postId="<?= $postId ?>"
                                       data-id="<?= $id ?>"/>
                                <span onClick="loadEditEvent(<?= $id ?>)" class="liveControl" title="Sửa sự kiện">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </span>
                                <span class="liveControl" 
                                      onClick="delLive(<?= $id . "," . $postId ?>)" 
                                      title="Xóa sự kiện">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </span>
                                <?php
                                if ($v['UrlVideo'] != null) {
                                    ?>
                                    <span onClick="loadVideoDemo(<?= $id ?>);" 
                                          id="demoVideo<?= $id ?>" 
                                          class="liveControl" 
                                          title="Xem video">
                                        <i class="glyphicon glyphicon-play-circle"></i>
                                    </span>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                    <?php }
                    ?>

                <input type="hidden" name="orderLive" value="<?= $order ?>" id="orderLive"/>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--Add-->
<div class="modal fade in" id="Modle_Live" tabindex="-1" role="dialog" aria-labelledby="Modle_Live">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="padding: 10px 0px;">
                <div class="col-xs-4 remove-padding">
                    <div class="form-group col-xs-12 ">
                        <label>Phút</label>
                        <input type="hidden" value="<?= Yii::$app->request->getCsrfToken(); ?>" id="_csrf"/>
                        <input name="minute" id="minute" class="form-control" value="" type="text"/>
                        <input type="hidden" value="" name="idEvent" id="idEvent"/>
                        <input type="hidden" value="" name="actionEvent" id="actionEvent"/>
                    </div>
                    <div class="form-group col-xs-12">
                        <label>Loại sự kiện</label>
                        <select class="form-control" id="type_event" name="type_event">
                            <option value="0">Text Thường</option>
                            <option value="1">ĐỘI HÌNH RA SÂN</option>
                            <option value="2">TRẬN ĐẤU BẮT ĐẦU</option>
                            <option value="3">BÙ GIỜ</option>
                            <option value="4">PHẠT GÓC</option>
                            <option value="5">PENALTY</option>
                            <option value="6">GHI BÀN</option>
                            <option value="7">THAY NGƯỜI</option>
                            <option value="8">THẺ VÀNG</option>
                            <option value="9">THẺ VÀNG THỨ 2</option>
                            <option value="10">THẺ ĐỎ</option>
                            <option value="11">CHẤN THƯƠNG</option>
                            <option value="12">TRÚNG XÀ</option>
                        </select>
                    </div>
                    <div class="form-group col-xs-12 ">
                        <label>Sắp xếp</label>
                        <input type="text" id="frmOrder" name="order" class="form-control" value="1"/>
                    </div>
                </div>

                <div class="col-xs-6 col-xs-push-2">
                    <video id="preVideo" controls="" src="" height="150px" width="100%"></video>
                    <div style="margin-top: 10px; position: relative;">
                        <a class="btn btn-default">Chọn video
                            <input style="position: absolute;
                                   top: 0;
                                   left: 0;
                                   opacity: 0;
                                   width: 100%;
                                   height: 100%;" id="uploadVideo" title="Chọn video" data-preview="video-live-preview" accept="video/mp4" type="file">
                        </a>
                    </div>
                </div>
                <div class="form-group col-xs-12 postAdv">
                    <div class="controlAdv" style="top: 34px;right: 24px;">
                        <img src="/img/load.gif" class="iconLoading" id="loadContent"/>
                        <span class="btn btn-default btn-xs">
                            <?= Html::fileInput('editorImg[]', '', ['data-image-editor' => 'Content', 'multiple' => 'multiple']) ?>
                            <i class="glyphicon glyphicon-picture"></i>
                        </span>
                    </div>
                    <label class="block">Nội dung</label>
                    <textarea id="Content" name="Content" class="form-group"></textarea>
                    <script>
                        CKEDITOR.replace('Content');
                    </script>
                </div>
                <div style="clear: both"></div>
                <div class="form-group col-xs-12">
                    <div style="float: right;margin-top: 10px">
                        <div id="button-add-live">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                            <button type="button" onClick="addEventFrm();" id="insert-live" class="btn btn-primary ">Lưu lại</button>
                        </div>
                    </div>
                </div>
                <div style="clear: both"></div>
            </div>
        </div>
    </div>
</div>
<!--Video-->
<div class="modal fade in" id="demoVideo" tabindex="-1" role="dialog" aria-labelledby="demoVideo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="padding: 10px 0px;">
                <div class="form-group col-xs-12">
                    <video style="width: 100%;" src="" controls="true" muted="true" id="videoLiveDemo"/>
                </div>
                <div style="clear: both"></div>
                <div class="form-group col-xs-12">
                    <div style="float: right;margin-top: 10px">
                        <div id="button-add-live">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
                <div style="clear: both"></div>
            </div>
        </div>
    </div>
</div>