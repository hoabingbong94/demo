<?php

namespace app\modules\app90phut\models;

use Yii;

/**
 * This is the model class for table "Extend_Image".
 *
 * @property integer $ID
 * @property string $ImageLink
 * @property string $Url
 * @property integer $Active
 * @property string $ImageName
 * @property string $DateCreate
 * @property string $DateUpdate
 * @property string $YoutubeKey
 * @property string $Video
 * @property integer $Size
 * @property integer $AlbumID
 * @property integer $UserUpdate
 */
class AlbumImageItem extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Extend_Image';
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
            [['Active', 'Size', 'AlbumID', 'UserUpdate'], 'integer'],
            [['DateCreate', 'DateUpdate'], 'safe'],
            [['Video'], 'string'],
            [['ImageLink', 'Url', 'ImageName', 'YoutubeKey'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'ImageLink' => 'Image Link',
            'Url' => 'Url',
            'Active' => 'Active',
            'ImageName' => 'Image Name',
            'DateCreate' => 'Date Create',
            'DateUpdate' => 'Date Update',
            'YoutubeKey' => 'Youtube Key',
            'Video' => 'Video',
            'Size' => 'Size',
            'AlbumID' => 'Album ID',
            'UserUpdate' => 'User Update',
        ];
    }

}
