<div class="list-item-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="col-md-8 remove-padding">
                <h3 class="panel-title"><i class="glyphicon glyphicon-time"></i> Lịch sử cập nhật bài tin</h3>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <?php
                foreach ($data as $k => $v) {
                    $id = $k + 1;
                    $fullname = $v['fullname'];
                    $classIn = "in";
                    $dateUpdate = date('d-m-Y H:i:s', strtotime($v['DateUpdate']));
                    if ($k > 0) {
                        $classIn = "";
                    }
                    $title = $v['Content'];
                    $img = $v['Thumbnails'];
                    if ($v['Thumbnails'] == '') {
                        $img = $v['Logo'];
                    }
                    $img = $img;
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title" style="font-size: 13px;">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#post<?= $k ?>" aria-expanded="true" aria-controls="post<?= $k ?>">
                                    Bởi: <?= $fullname ?>
                                </a>
                                <span style="float: right;">Cập nhật: <?= $dateUpdate ?></span>
                            </h4>
                        </div>
                        <div id="post<?= $k ?>" class="panel-collapse collapse <?= $classIn ?>" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">

                                <ul class="media-list">
                                    <li class="media">
                                        <div class="media-left">
                                            <a href="#"> 
                                                <img src="http://90phut.vn/service/<?= $img; ?>" data-holder-rendered="true"> 
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <div class="head">
                                                <h4 class="media-heading post-index-h4">
                                                    <?php echo $v['CategoryName'] ?>
                                                </h4>
                                                <span class="minute">
                                                    <?= date("d-m-Y H:i:s", strtotime($v['DateUpdate'])); ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="content">
                                                <span class="cotentArt" style="max-height: 100%;"><?= $title; ?></span>
                                            </div>
                                            <div style="width: 100%;position: relative;">
                                                <span class="post-index-fullname" style="margin-top: 5px;">
                                                    Tạo bởi : <?= $v['fullname']; ?> 
                                                    | Xuất bản: <?= date("d-m-Y H:i:s", strtotime($v['DatePublic'])); ?>
                                                    <br/>
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>


                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

        </div>
    </div>
</div>