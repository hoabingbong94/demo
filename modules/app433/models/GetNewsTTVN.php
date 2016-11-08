<?php

namespace app\modules\app433\models;

use Yii;

/**
 * This is the model class for table "Get_News_TTVN".
 *
 * @property integer $ID
 * @property string $Title
 * @property string $Thumb
 * @property string $Description
 * @property string $Url_Video
 * @property string $Content
 * @property string $Categories
 * @property integer $Type
 * @property string $Author
 * @property string $DateCreate
 * @property integer $News_ID
 * @property integer $Status
 */
class GetNewsTTVN extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Get_News_TTVN';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Content'], 'string'],
            [['Type', 'News_ID', 'Status'], 'integer'],
            [['DateCreate'], 'safe'],
            [['Title'], 'string', 'max' => 250],
            [['Thumb', 'Url_Video'], 'string', 'max' => 200],
            [['Description'], 'string', 'max' => 400],
            [['Categories', 'Author'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'Title' => 'Title',
            'Thumb' => 'Thumb',
            'Description' => 'Description',
            'Url_Video' => 'Url  Video',
            'Content' => 'Content',
            'Categories' => 'Categories',
            'Type' => 'Type',
            'Author' => 'Author',
            'DateCreate' => 'Date Create',
            'News_ID' => 'News  ID',
            'Status' => 'Status',
        ];
    }

}
