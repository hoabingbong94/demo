<?php

namespace app\modules\app90phut\models;

use Yii;

/**
 * This is the model class for table "Extend_Album_Image".
 *
 * @property integer $ID
 * @property string $AlbumName
 * @property string $Avatar
 * @property integer $Active
 * @property integer $Type
 * @property integer $CategoryID
 * @property string $DateCreate
 * @property string $DateUpdate
 * @property integer $UserUpdate
 * @property string $Description
 * @property string $Author
 * @property integer $AllowEdit
 */
class AlbumImage extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Extend_Album_Image';
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
            [['Avatar'], 'string'],
            [['Active', 'Type', 'CategoryID', 'UserUpdate', 'AllowEdit'], 'integer'],
            [['DateCreate', 'DateUpdate'], 'safe'],
            [['AlbumName'], 'string', 'max' => 150],
            [['Description'], 'string', 'max' => 5000],
            [['Author'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'AlbumName' => 'Tên album',
            'Avatar' => 'Ảnh đại diện',
            'Active' => 'Trạng thái',
            'Type' => 'Kiểu album',
            'CategoryID' => 'Chuyên mục',
            'DateCreate' => 'Ngày tạo',
            'DateUpdate' => 'Ngày cập nhật',
            'UserUpdate' => 'Người cập nhạt',
            'Description' => 'Mô tả',
            'Author' => 'Bút danh',
        ];
    }

}
