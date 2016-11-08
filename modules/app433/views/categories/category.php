<ul>
<?php $i = 0;
?>
<?php foreach ($listCategories as $row) { ?>
    <?php
    if ($row["ParentID"] == 0) {
        $check = 0;
        ?>
        <?php foreach ($listCategories as $row1) { ?>
            <?php if ($row1["ParentID"] == $row["CategoryID"]) { ?>
                <?php if ($check == 0) {
                    $check = 1 ?>
                    <li><input type="checkbox" id="item-8"/>
                        <label for="item-<?= $i ?>">
                            <img src="http://posts.media.profile.bongda433.com/images/logo/1457278348399.png" class="img-categories-logo"/>
                            <a class="title-category"
                               href="/categories/update/<?= $row['ParentID'] ?>"
                               title="Sửa"><?= $row["CategoryName"] ?></a>

                            <span title="Đang hiển thị"
                                  class="glyphicon fa fa-circle show-color"></span>
                <?php } ?>

                <?php if ($check == 0) { ?>

                        </label>
                    </li>  
                <?php } ?>

            <?php } ?>
        <?php } ?>
        <?php if ($check == 0) { ?>
            <li class="list-item title-category">
                <img src="<?= $imagePath . $row["Logo"] ?>"
                     class="img-categories-logo"/>
                <a class="title-category"
                   href="/categories/update/<?= $row['ParentID'] ?>"
                   title="Sửa"><?= $row["CategoryName"] ?></a>

                <span title="Đang hiển thị"
                      class="glyphicon fa fa-circle show-color"></span>

            </li>
        <?php } ?>

        <?php $i++;
    } ?>
<?php } ?>
</ul>