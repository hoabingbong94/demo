<?php

/**
 * Created by PhpStorm.
 * User: cau
 * Date: 6/1/2016
 * Time: 5:20 PM
 */

namespace app\modules\app90phut\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "Category".
 *
 * @property integer $CategoryID
 * @property integer $ParentID
 * @property string $CategoryName
 * @property integer $OrderIndex
 * @property integer $ShowHome
 * @property integer $ShowMenu
 * @property integer $ExtendAllowGet
 */
class Category extends ActiveRecord {

    public static function tableName() {
        return 'Category';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['ParentID', 'OrderIndex', 'ShowHome', 'ShowMenu', 'ExtendAllowGet'], 'integer'],
            [['CategoryName'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'CategoryID' => 'Category ID',
            'ParentID' => 'Parent ID',
            'ShowHome' => 'Show Home',
            'ShowMenu' => 'Show Menu',
            'CategoryName' => 'Category Name',
            'ExtendAllowGet' => 'ExtendAllowGet',
            'OrderIndex' => 'Order Index'
        ];
    }

    public static function getDb() {
        // use the "db2" application component
        return \Yii::$app->db2;
    }

}

?>