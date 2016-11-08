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