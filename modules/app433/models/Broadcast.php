<?php

namespace app\modules\app433\models;

use Yii;

/**
 * This is the model class for table "Broadcast".
 *
 * @property integer $ID
 * @property string $Avatar
 * @property integer $HomeId
 * @property string $HomeColor
 * @property integer $AwayId
 * @property string $AwayColor
 * @property string $StartTime
 * @property string $Channel
 * @property string $Sopcast
 * @property integer $LiveStream
 * @property string $LiveStreamLink
 * @property integer $CategoriesID
 * @property integer $Status
 * @property string $DateCreate
 * @property string $DateUpdate
 * @property integer $UserCreate
 * @property integer $UserUpdate
 */
class Broadcast extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Broadcast';
    }

//    public function attributes() {
//        $attributes = parent::attributes();
//        return array_merge($attributes, [
//            'phone'
//        ]);
//    }
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['HomeId', 'AwayId', 'LiveStream', 'CategoriesID', 'Status', 'UserCreate', 'UserUpdate'], 'integer'],
            [['StartTime', 'DateCreate', 'DateUpdate'], 'safe'],
            [['Sopcast', 'Avatar'], 'string'],
            [['HomeColor', 'AwayColor'], 'string', 'max' => 10],
            [['Channel', 'LiveStreamLink'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'Avatar' => 'Avatar',
            'HomeId' => 'Home ID',
            'HomeColor' => 'Home Color',
            'AwayId' => 'Away ID',
            'AwayColor' => 'Away Color',
            'StartTime' => 'Start Time',
            'Channel' => 'Channel',
            'Sopcast' => 'Sopcast',
            'LiveStream' => 'Live Stream',
            'LiveStreamLink' => 'Live Stream Link',
            'CategoriesID' => 'Categories ID',
            'Status' => 'Status',
            'DateCreate' => 'Date Create',
            'DateUpdate' => 'Date Update',
            'UserCreate' => 'User Create',
            'UserUpdate' => 'User Update',
        ];
    }

}
