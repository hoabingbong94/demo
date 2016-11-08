<ul class="media-list">
    <?php 
    //var_dump($data["post_short_433"]); die;
    foreach($data["433_video"] as $row){?>
    <li class="media">
        <div class="media-left">
            <a href="#">
                <?php
                    if($row["ThumbVideo"]!= null && $row["ThumbVideo"]!=""){
                        $image = $row["ThumbVideo"];
                    }else{
                        $image = $row["Logo"];
                    }
                ?>
                <img class="index-image" src="http://posts.media.profile.bongda433.com/<?=$image?>" data-holder-rendered="true"> 
            </a>
        </div>
        <div class="media-body">
            <div class="head">
                <h4 class="media-heading post-index-h4">
                    
                    <?=  str_replace("[tag]", "", str_replace("[/tag]", "", $row["Content"]))?> 
                </h4>
 
            </div>
            <div class="clear"></div>
            <div class="content">
               
            </div>
            <div style="width: 100%;position: relative;">
                <span class="index-fullname" style="margin-top: 5px;">
                    <i class="fa fa-user" aria-hidden="true"></i> <?=$row["FullName"]?> 
                    | <i class="fa fa-file-text-o" aria-hidden="true"></i> <?= date('H:i:s d/m/Y',strtotime($row["DateCreate"]))?>                                                                                                                                                          <br>
                </span>
            </div>
        </div>
    </li>
    <?php } ?>
</ul>
