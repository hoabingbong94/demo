<?php

namespace app\modules\app90phut\models;

use Yii;

/**
 * This is the model class for table "Soccer_BroadCast".
 *
 * @property integer $ID
 * @property string $AwayName
 * @property string $HomeName
 * @property string $Date_BroadCast
 * @property string $Time_BroadCast
 * @property string $Channel
 * @property string $Delete
 * @property string $DateCreate
 * @property string $DateUpdate
 * @property integer $UserCreate
 * @property integer $UserUpdate
 */
class BroadCast extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Soccer_BroadCast';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db2');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Date_BroadCast', 'Time_BroadCast'], 'safe'],
            [['AwayName', 'HomeName', 'Channel', 'DateCreate', 'DateUpdate'], 'string'],
            [['UserCreate', 'Delete', 'UserUpdate'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'AwayName' => 'Đội khách',
            'HomeName' => 'Đội nhà',
            'Date_BroadCast' => 'Ngày phát sóng',
            'Time_BroadCast' => 'Giờ phát sóng',
            'Channel' => 'Kênh',
        ];
    }

}
