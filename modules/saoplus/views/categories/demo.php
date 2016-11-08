<div class="css-treeview">
    <ul>
        <?php $i = 0; ?>
        <?php foreach ($listCategories as $row) { ?>
            <?php if ($row["ParentId"] == 0) { ?>
                <?php if ($row["check"] == 1) { ?>
                    <li><input type="checkbox" id="item-<?= $i ?>"/>
                        <label for="item-<?= $i ?>">
                            <span style=" height:100px; padding-top: 5px; padding-bottom: 7px; ;background: <?= $row['Background'] ?>;">
                                <img src="<?= $imagePath . $row["Icon"] ?>"  title="Icon"  class="img-categories-logo"/>
                            </span>
                            <a class="title-category title-categories"
                               href="/saoplus/categories/update?id=<?= $row['ID'] ?>"
                               title="Sửa"><?= $row["Title"] ?></a>

                            <?php if ($row["Status"] == 1) { ?>
                                <span title="Đang hiển thị" class="glyphicon fa fa-circle show-color"></span>
                            <?php } else { ?>
                                <span title="Đang hiển thị" class="glyphicon fa fa-circle hide-color"></span>
                            <?php } ?>     


                        </label>
                        <ul>       
                            <?php $j = 0; ?>
                            <?php
                            foreach ($listCategories as $row1) {
                                ?>

                                <?php if ($row1["ParentId"] == $row["ID"]) { ?>
                                    <?php if ($row1["check"] == 1) { ?>
                                        <li><input type="checkbox" id="item-<?= $i . "-" . $j ?>"/>
                                            <label for="item-<?= $i . "-" . $j ?>" >
                                                <span style=" height:100px; padding-top: 5px; padding-bottom: 7px; ;background: <?= $row['Background'] ?>;">
                                                    <img src="<?= $imagePath . $row1["Icon"] ?>"   title="Icon"  class="img-categories-logo"/>
                                                </span>
                                                </span>
                                                <a class="title-category title-categories"
                                                   href="/saoplus/categories/update?id=<?= $row1['ID'] ?>"
                                                   title="Sửa"><?= $row1["Title"] ?></a>
                                                   <?php if ($row1["Status"] == 1) { ?>
                                                    <span title="Đang hiển thị" class="glyphicon fa fa-circle show-color"></span>
                                                <?php } else { ?>
                                                    <span title="Đang hiển thị" class="glyphicon fa fa-circle hide-color"></span>
                                                <?php } ?>

                                            </label>
                                            <ul> 
                                                <?php foreach ($listCategories as $row2) { ?>
                                                    <?php if ($row2["ParentId"] == $row1["ID"]) { ?>
                                                        <li class="list-item title-category title-categories">
                                                            <span style=" height:100px; padding-top: 5px; padding-bottom: 7px; ;background: <?= $row['Background'] ?>;">
                                                                <img src="<?= $imagePath . $row2["Icon"] ?>"
                                                                     title="Icon"   class="img-categories-logo"/>
                                                            </span>
                                                            <a class="title-category title-categories"
                                                               href="/saoplus/categories/update?id=<?= $row2['ID'] ?>"
                                                               title="Sửa"><?= $row2["Title"] ?></a>

                                                            <?php if ($row2["Status"] == 1) { ?>
                                                                <span title="Đang hiển thị" class="glyphicon fa fa-circle show-color"></span>
                                                            <?php } else { ?>
                                                                <span title="Đang hiển thị" class="glyphicon fa fa-circle hide-color"></span>
                                                            <?php } ?>

                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </li>  
                                    <?php } else { ?>
                                        <li class="list-item title-category title-categories">
                                            <span style=" height:100px; padding-top: 5px; padding-bottom: 7px; ;background: <?= $row['Background'] ?>;">
                                                <img src="<?= $imagePath . $row1["Icon"] ?>" title="Icon" 
                                                     class="img-categories-logo"/>
                                            </span>
                                            <a class="title-category title-categories"
                                               href="/saoplus/categories/update?id=<?= $row1['ID'] ?>"
                                               title="Sửa"><?= $row1["Title"] ?></a>

                                            <?php if ($row1["Status"] == 1) { ?>
                                                <span title="Đang hiển thị" class="glyphicon fa fa-circle show-color"></span>
                                            <?php } else { ?>
                                                <span title="Đang hiển thị" class="glyphicon fa fa-circle hide-color"></span>
                                            <?php } ?>

                                        </li>
                                        <?php
                                    }
                                }
                            }
                            ?> 

                        </ul>
                    </li>  
                <?php } else { ?>

                    <li class="list-item title-category title-categories">
                        <span style=" height:100px; padding-top: 5px; padding-bottom: 7px; ;background: <?= $row['Background'] ?>;">
                            <img src="<?= $imagePath . $row["Icon"] ?>"  title="Icon" 
                                 class="img-categories-logo"/>
                        </span>
                        <a class="title-category title-categories"
                           href="/saoplus/categories/update?id=<?= $row['ID'] ?>"
                           title="Sửa"><?= $row["Title"] ?></a>

                        <?php if ($row["Status"] == 1) { ?>
                            <span title="Đang hiển thị" class="glyphicon fa fa-circle show-color"></span>
                        <?php } else { ?>
                            <span title="Đang hiển thị" class="glyphicon fa fa-circle hide-color"></span>
                        <?php } ?>     

                    </li>
                <?php } ?>
            <?php } ?>
            <?php
            $i++;
        }
        ?>
    </ul>
</div>