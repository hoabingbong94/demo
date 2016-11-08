

<?php
$controller = $this->context;
//$menus = $controller->module->menus;
$route = $controller->route;
//
//foreach ($menus as $i => $menu) {
//    $menus[$i]['active'] = strpos($route, trim($menu['url'][0], '/')) === 0;
//}
//$this->params['nav-items'] = $menus;
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="col-md-12" id="right">
     <script src="/libs/ckeditor/ckeditor.js"></script>
    <?= $content ?>
</div>
<?php $this->endContent();

