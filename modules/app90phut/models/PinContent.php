<?php

namespace app\modules\app90phut\models;

use Yii;

/**
 * This is the model class for table "Pin_Content".
 *
 * @property integer $ID
 * @property string $Title
 * @property integer $Type
 * @property string $Image
 * @property integer $ContentID
 * @property string $DateCreate
 * @property integer $UserCreate
 * @property integer $Public
 */
class PinContent extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Pin_Content';
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
            [['Type', 'ContentID', 'UserCreate', 'Public'], 'integer'],
            [['ContentID'], 'required'],
            [['DateCreate'], 'safe'],
            [['Title', 'Image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'Title' => 'Title',
            'Type' => 'Type',
            'Image' => 'Image',
            'ContentID' => 'Content ID',
            'DateCreate' => 'Date Create',
            'UserCreate' => 'User Create',
            'Public' => 'Public',
        ];
    }

}
