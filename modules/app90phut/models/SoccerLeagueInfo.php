<?php

namespace app\modules\app90phut\models;

use Yii;

/**
 * This is the model class for table "Soccer_LeagueInfo".
 *
 * @property integer $ID
 * @property string $Name
 * @property string $Logo
 * @property string $CurrentRound
 * @property string $Code_Param1
 * @property string $Code_Param2
 * @property string $Code_Param3
 * @property string $Code_Param4
 * @property string $Code_Param5
 * @property string $Code_Param6
 * @property string $Name_VN
 * @property string $BXH
 * @property string $Name_VN_Unicode
 * @property integer $Display_Order
 * @property integer $CategoryID
 * @property string $Product_ID
 * @property string $Service_ID
 * @property string $Images
 */
class SoccerLeagueInfo extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Soccer_LeagueInfo';
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
            [['ID'], 'required'],
            [['ID', 'Display_Order', 'CategoryID'], 'integer'],
            [['Name', 'Logo'], 'string', 'max' => 150],
            [['CurrentRound'], 'string', 'max' => 100],
            [['Code_Param1', 'Code_Param2', 'Code_Param3', 'Code_Param4', 'Code_Param5', 'Code_Param6', 'Name_VN', 'BXH', 'Name_VN_Unicode', 'Product_ID', 'Service_ID'], 'string', 'max' => 50],
            [['Images'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'Name' => 'Name',
            'Logo' => 'Logo',
            'CurrentRound' => 'Current Round',
            'Code_Param1' => 'Code  Param1',
            'Code_Param2' => 'Code  Param2',
            'Code_Param3' => 'Code  Param3',
            'Code_Param4' => 'Code  Param4',
            'Code_Param5' => 'Code  Param5',
            'Code_Param6' => 'Code  Param6',
            'Name_VN' => 'Name  Vn',
            'BXH' => 'Bxh',
            'Name_VN_Unicode' => 'Name  Vn  Unicode',
            'Display_Order' => 'Display  Order',
            'CategoryID' => 'Category ID',
            'Product_ID' => 'Product  ID',
            'Service_ID' => 'Service  ID',
            'Images' => 'Images',
        ];
    }

}
