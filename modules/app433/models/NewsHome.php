<?php

namespace app\modules\app433\models;

use Yii;

/**
 * This is the model class for table "News_Home".
 *
 * @property integer $ID
 * @property integer $PostID
 * @property string $Title
 * @property integer $OrderNumber
 * @property integer $Status
 * @property string $DateCreate
 * @property string $DateUpdate
 * @property integer $UserCreate
 * @property integer $UserUpdate
 */
class NewsHome extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'News_Home';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['PostID', 'OrderNumber', 'Status', 'UserCreate', 'UserUpdate'], 'integer'],
            [['DateCreate', 'DateUpdate'], 'safe'],
            [['Title'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'PostID' => 'Post ID',
            'Title' => 'Title',
            'OrderNumber' => 'Order Number',
            'Status' => 'Status',
            'DateCreate' => 'Date Create',
            'DateUpdate' => 'Date Update',
            'UserCreate' => 'User Create',
            'UserUpdate' => 'User Update',
        ];
    }

}
