<?php

namespace app\modules\app433\models;

use Yii;

/**
 * This is the model class for table "Post_90phut".
 *
 * @property integer $ID
 * @property integer $NewsId
 * @property integer $StarId
 * @property integer $PostID
 * @property string $DateCreate
 * @property integer $UserCreate
 * @property integer $Type
 */
class Post90phut extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Post_90phut';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['NewsId', 'UserCreate', 'StarId', 'Type'], 'integer'],
            [['DateCreate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'NewsId' => 'News ID',
            'DateCreate' => 'Date Create',
            'UserCreate' => 'User Create',
        ];
    }

}
