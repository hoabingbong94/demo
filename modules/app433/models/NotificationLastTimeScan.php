<?php

namespace app\modules\app433\models;

use Yii;

/**
 * This is the model class for table "Notification_LastTimeScan".
 *
 * @property integer $ID
 * @property string $DateScan
 * @property integer $TotalRecord
 * @property integer $Type
 */
class NotificationLastTimeScan extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Notification_LastTimeScan';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['DateScan'], 'safe'],
            [['TotalRecord', 'Type'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'DateScan' => 'Date Scan',
            'TotalRecord' => 'Total Record',
            'Type' => 'Type',
        ];
    }

}
