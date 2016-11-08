

<?php
$controller = $this->context;
$route = $controller->route;
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="col-md-3" id="left">
    <?PHP
    $listMenu = [
        ['name' => 'Chuyên mục', 'link' => 'saoplus/categories', 'icon' => 'fa fa-bars'],
        ['name' => 'Video', 'link' => 'saoplus/videos/index', 'icon' => 'fa fa-film'],
    ];
    ?>
    <section class="menu-custom">
        <ul>
            <?php
            foreach ($listMenu as $k => $v) {
                $classActive = "";
                if (strpos($route, $v['link']) === 0) {
                    $classActive = 'active';
                }
                echo '<li class="' . $classActive . '"><a href="/' . $v['link'] . '"><i class="' . $v['icon'] . '" aria-hidden="true"></i> ' . $v['name'] . '</a></li>';
            }
            ?>
        </ul>
    </section>

</div>
<div class="col-md-9" id="right">
    <script src="/libs/ckeditor/ckeditor.js"></script>
    <?= $content ?>
    <?php echo $this->render('element/Notification'); ?>
</div>
<?php
$this->endContent();
