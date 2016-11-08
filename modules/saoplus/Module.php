<?php

namespace app\modules\saoplus;

/**
 * saoplus module definition class
 */
class Module extends \yii\base\Module {

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\saoplus\controllers';

    /**
     * @inheritdoc
     */
    public function init() {
        $this->layout = "site";
        parent::init();

        // custom initialization code goes here
    }

}
