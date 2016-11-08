<?php

namespace app\modules\app433\models;

use Yii;

/**
 * This is the model class for table "Categories".
 *
 * @property integer $CategoryID
 * @property integer $ParentID
 * @property string $Logo
 * @property string $Image_Cover
 * @property string $CategoryName
 * @property string $Title
 * @property string $TitleAlias
 * @property string $Keyword
 * @property integer $OrderIndex
 * @property integer $Public
 * @property integer $UserCreate
 * @property integer $UserUpdate
 */
class Categories extends \yii\db\ActiveRecord {

    public static function getDb() {
        // use the "db2" application component
        return Yii::$app->get('db');
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Categories';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['ParentID', 'OrderIndex', 'Public', 'Style', 'UserCreate', 'UserUpdate'], 'integer'],
            [['Logo', 'LogoPC', 'Image_Cover', 'Title', 'TitleAlias', 'Keyword', 'Description'], 'string'],
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
            'Logo' => 'Logo',
            'Image_Cover' => 'Image  Cover',
            'CategoryName' => 'Category Name',
            'Title' => 'Title',
            'TitleAlias' => 'Title Alias',
            'Keyword' => 'Keyword',
            'Description' => 'Description',
            'OrderIndex' => 'Order Index',
            'Public' => 'Public',
            'Style' => 'Style',
            'UserCreate' => 'User Create',
            'UserUpdate' => 'User Update',
        ];
    }

}
