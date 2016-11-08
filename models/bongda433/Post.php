<?php

namespace app\models\bongda433;

use Yii;

/**
 * This is the model class for table "Post".
 *
 * @property integer $ID
 * @property integer $CategoryID
 * @property integer $Type
 * @property string $Title
 * @property integer $MatchID
 * @property string $Thumbnails
 * @property string $Thumb
 * @property string $UrlVideo
 * @property string $UrlVideo144p
 * @property string $UrlVideo240p
 * @property string $UrlVideoToken
 * @property string $ThumbVideo
 * @property string $Content
 * @property string $ContentNone
 * @property string $ContentExtend
 * @property string $ContentExtendNone
 * @property string $Keyword
 * @property integer $Recommened
 * @property integer $View
 * @property string $DatePublic
 * @property integer $UserCreate
 * @property integer $UserUpdate
 * @property integer $UserLiveEdit
 * @property string $DateCreate
 * @property string $DateUpdate
 * @property integer $Live
 * @property integer $Pin
 * @property integer $PinVideo
 * @property integer $PinRecommened
 * @property integer $Public
 * @property integer $IsDelete
 *  * @property string $Summary
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CategoryID', 'Type', 'MatchID', 'Recommened', 'View', 'UserCreate', 'UserUpdate', 'UserLiveEdit', 'Live', 'Pin', 'PinVideo', 'PinRecommened', 'Public', 'IsDelete'], 'integer'],
            [['Thumbnails','Content', 'ContentNone', 'ContentExtend', 'ContentExtendNone','ThumbVideo','Summary'], 'string'],
            [['ContentNone', 'ContentExtendNone'], 'required'],
            [['DatePublic', 'DateCreate', 'DateUpdate'], 'safe'],
            [['Title', 'UrlVideoToken'], 'string', 'max' => 50],
            [['Thumb', 'UrlVideo', 'UrlVideo144p', 'UrlVideo240p'], 'string', 'max' => 255],
            [['Keyword'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'CategoryID' => 'Category ID',
            'Type' => 'Type',
            'Title' => 'Tiêu đề',
            'MatchID' => 'Match ID',
            'Thumbnails' => 'Thumbnails',
            'Thumb' => 'Thumb',
            'UrlVideo' => 'Url Video',
            'UrlVideo144p' => 'Url Video144p',
            'UrlVideo240p' => 'Url Video240p',
            'UrlVideoToken' => 'Url Video Token',
            'ThumbVideo' => 'Thumb Video',
            'Content' => 'Nội dung chính',
            'ContentNone' => 'Content None',
            'ContentExtend' => 'Nội dung mở rộng',
            'ContentExtendNone' => 'Content Extend None',
            'Keyword' => 'Keyword',
            'Recommened' => 'Recommened',
            'View' => 'View',
            'DatePublic' => 'Date Public',
            'UserCreate' => 'User Create',
            'UserUpdate' => 'User Update',
            'UserLiveEdit' => 'User Live Edit',
            'DateCreate' => 'Date Create',
            'DateUpdate' => 'Date Update',
            'Live' => 'Live',
            'Pin' => 'Pin',
            'PinVideo' => 'Pin Video',
            'PinRecommened' => 'Pin Recommened',
            'Public' => 'Public',
            'IsDelete' => 'Is Delete',
            'CategoryName' => 'Category Name',
            'Summary' => 'Mô tả',
        ];
    }
}
