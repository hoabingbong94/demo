<?php

namespace app\modules\app90phut\models;

use Yii;

/**
 * This is the model class for table "Extend_Star".
 *
 * @property integer $ID
 * @property string $Title
 * @property string $Summary
 * @property string $Thumbnails
 * @property string $Contents
 * @property string $Keyword
 * @property string $Author
 * @property string $Source
 * @property string $ReleaseDate
 * @property string $DateUpdate
 * @property integer $IsPublic
 * @property integer $UserUpdate
 * @property integer $UserCreate
 * @property string $ContentsExtend
 * @property integer $CategoryID
 * @property integer $AllowEdit
 */
class Star extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public $category433;
    public $thumbnailsCover;

    public static function tableName() {
        return 'Extend_Star';
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
            [['Title', 'Summary', 'Thumbnails', 'Contents', 'Keyword', 'Source', 'IsPublic', 'CategoryID'], 'required'],
            [['Title', 'Summary', 'Contents', 'ContentsExtend', 'Thumbnails', 'thumbnailsCover', 'DateUpdate'], 'string'],
            [['ReleaseDate'], 'safe'],
            [['IsPublic', 'UserUpdate', 'category433', 'CategoryID', 'UserCreate', 'AllowEdit'], 'integer'],
            [['Keyword', 'Author', 'Source'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'Title' => 'Tiêu đề',
            'Summary' => 'Mô tả',
            'Thumbnails' => 'Ảnh đại diện',
            'Contents' => 'Nội dung',
            'Keyword' => 'Từ khóa',
            'Author' => 'Author',
            'Source' => 'Nguồn',
            'ReleaseDate' => 'Release Date',
            'IsPublic' => 'Is Public',
            'UserUpdate' => 'User Update',
            'ContentsExtend' => 'Nội dung mở rộng',
        ];
    }

}
