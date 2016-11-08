<?php

namespace app\modules\app433\models;

use Yii;

/**
 * This is the model class for table "Banner".
 *
 * @property integer $ID
 * @property string $Title
 * @property string $Images
 * @property string $DateCreate
 * @property string $DateUpdate
 * @property string $UserCreate
 * @property string $UserUpdate
 * @property integer $Public
 */
class Banner extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Banner';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['DateCreate', 'DateUpdate', 'UserCreate', 'UserUpdate'], 'safe'],
            [['Public'], 'integer'],
            [['Title', 'Images'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'Title' => 'Title',
            'Images' => 'Images',
            'DateCreate' => 'Date Create',
            'DateUpdate' => 'Date Update',
            'UserCreate' => 'User Create',
            'UserUpdate' => 'User Update',
            'Public' => 'Public',
        ];
    }

}
