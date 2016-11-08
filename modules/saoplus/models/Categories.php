<?php

namespace app\modules\saoplus\models;

use Yii;

/**
 * This is the model class for table "Categories".
 *
 * @property integer $ID
 * @property string $Title
 * @property string $Description
 * @property string $Alias
 * @property string $Background
 * @property string $Icon
 * @property integer $ParentId
 * @property integer $Order
 * @property integer $Status
 * @property integer $ShowHome
 * @property string $DateCreate
 * @property string $DateUpdate
 * @property integer $UserCreate
 * @property integer $UserUpdate
 */
class Categories extends \yii\db\ActiveRecord {

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
            [['ParentId', 'Order', 'Status', 'ShowHome', 'UserCreate', 'UserUpdate'], 'integer'],
            [['DateCreate', 'DateUpdate'], 'safe'],
            [['Title'], 'string', 'max' => 200],
            [['Alias'], 'string', 'max' => 250],
            [['Background'], 'string', 'max' => 50],
            [['Icon', 'Description'], 'string'],
            [['Icon', 'Description', 'Title', 'Background'], 'required'],
        ];
    }

    public static function getDb() {
        return Yii::$app->get('db3');
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'Title' => 'Tiêu đề',
            'Description' => 'Mô tả',
            'Alias' => 'Alias',
            'Background' => 'Background',
            'Icon' => 'Icon',
            'ParentId' => 'Parent ID',
            'Order' => 'Order',
            'Status' => 'Status',
            'DateCreate' => 'Date Create',
            'DateUpdate' => 'Date Update',
            'UserCreate' => 'User Create',
            'UserUpdate' => 'User Update',
        ];
    }

}
