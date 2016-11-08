<?php

namespace app\modules\saoplus\models;

use Yii;

/**
 * This is the model class for table "Videos".
 *
 * @property integer $ID
 * @property string $Title
 * @property string $Alias
 * @property string $Description
 * @property string $Keywords
 * @property string $Thumbnail
 * @property string $Thumbnail_Hq
 * @property string $VideoFile
 * @property string $Time
 * @property integer $Pin_Slider
 * @property integer $CategoriesID
 * @property integer $Status
 * @property integer $View
 * @property string $DateCreate
 * @property string $DateUpdate
 * @property integer $UserCreate
 * @property integer $UserUpdate
 */
class Videos extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Videos';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
//            , 'Thumbnail'
            [['Pin_Slider', 'CategoriesID', 'Status', 'View', 'UserCreate', 'UserUpdate'], 'integer'],
            [['DateCreate', 'DateUpdate'], 'safe'],
            [['Title'], 'string', 'max' => 200],
            [['Description', 'Keywords'], 'string', 'max' => 250],
            [['Thumbnail', 'Thumbnail_Hq', 'VideoFile', 'Alias'], 'string'],
            [['Time'], 'string', 'max' => 50],
            [['Description', 'Title', 'VideoFile', 'Thumbnail_Hq'], 'required'],
            [['CategoriesID'], 'number', 'min' => 1, 'tooSmall' => 'Bạn chưa chọn chuyên mục'],
        ];
    }

    public static function getDb() {
        return Yii::$app->get('db3');
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'Title' => 'Tiêu đề',
            'Alias' => 'Alias',
            'Description' => 'Mô tả',
            'Keywords' => 'Keywords',
            'Thumbnail' => 'Ảnh đại diện',
            'Thumbnail_Hq' => 'Ảnh đại diện HD',
            'VideoFile' => 'Video',
            'Time' => 'Time',
            'View' => 'View',
            'Pin_Slider' => 'Pin  Slider',
            'CategoriesID' => 'Chuyên mục',
            'Status' => 'Status',
            'DateCreate' => 'Date Create',
            'DateUpdate' => 'Date Update',
            'UserCreate' => 'User Create',
            'UserUpdate' => 'User Update',
        ];
    }

}
