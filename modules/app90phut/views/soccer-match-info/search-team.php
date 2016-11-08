<?php
foreach ($data as $val) {
    ?>
    <div class="team-item" 
         id="<?= $val->TeamID ?>" 
         data-id="<?= $val->TeamID ?>"
         data-name="<?= $val->TeamName ?>"> 

        <span  class="button-team" onclick="insert_team('<?= $val->TeamID ?>', 1)"> Home </span>
        <span  class="button-team" onclick="insert_team('<?= $val->TeamID ?>', 0)"> Away </span>

        <span style="float:left;margin-left:15px"><?= $val->TeamName ?></span>
        <div style="clear:both;height:5px;"></div>
    </div>
    <hr style='margin-top:5px;margin-bottom:7px'></hr>
<?php } ?>
