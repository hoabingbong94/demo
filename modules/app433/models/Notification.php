<?php

namespace app\modules\app433\models;

use Yii;

/**
 * This is the model class for table "Notification".
 *
 * @property integer $ID
 * @property integer $NewsId
 * @property string $DateCreate
 * @property integer $Type
 */
class Notification extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Notification';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['NewsId', 'Type'], 'integer'],
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
            'Type' => 'Type',
        ];
    }

}
