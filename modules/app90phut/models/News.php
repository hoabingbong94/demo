<?php

namespace app\modules\app90phut\models;

use Yii;

/**
 * This is the model class for table "News".
 *
 * @property integer $ID
 * @property string $NewsID
 * @property integer $CategoryID
 * @property integer $Category
 * @property string $Title
 * @property string $Summary
 * @property string $Thumbnails
 * @property string $ThumbnailsPc
 * @property string $CoverImage
 * @property string $Contents
 * @property string $ExtendContentMobile
 * @property string $Keyword
 * @property string $Author
 * @property string $Source
 * @property string $ReleaseDate
 * @property integer $LikeCount
 * @property integer $ViewCount
 * @property integer $PostCount
 * @property string $ThumbnailsDesc
 * @property string $AudioPath
 * @property string $VideoPath
 * @property integer $ExtendIsPublic
 * @property integer $ExtendUserCreate
 * @property string $ExtendUpdateDate
 * @property string $ExtendUpdateTime
 * @property integer $ExtendHot
 * @property integer $ExtendGet
 * @property integer $ExtendVip
 * @property integer $ExtendUserUpdate
 * @property integer $ExtendTop
 * @property integer $ExtendUp
 * @property integer $ExtendMatchID
 * @property integer $ExtendHighLight
 * @property integer $AllowEdit
 */
class News extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public $category433;
    public $thumbnailsCover;

    public static function tableName() {
        return 'News';
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
            [['NewsID', 'LikeCount', 'ViewCount', 'PostCount',
            'ExtendIsPublic', 'ExtendUserCreate', 'ExtendHot', 'ExtendGet', 'ExtendVip',
            'ExtendUserUpdate', 'ExtendTop', 'ExtendUp',
            'ExtendMatchID', 'ExtendHighLight', 'category433', 'AllowEdit'], 'integer'],
            [['ExtendContentMobile'], 'string'],
            [['ReleaseDate', 'ExtendUpdateDate', 'ExtendUpdateTime'], 'safe'],
            [['Thumbnails', 'Contents', 'ThumbnailsPc', 'thumbnailsCover', 'CoverImage', 'Keyword'], 'string'],
            [['Author', 'Source', 'ThumbnailsDesc', 'AudioPath', 'VideoPath'], 'string'],
            [['Title'], 'required', 'message' => 'Tiêu đề không được bỏ trống'],
            [['Summary'], 'required', 'message' => 'Mô tả không được bỏ trống'],
            [['Thumbnails'], 'required', 'message' => 'Ảnh không được bỏ trống'],
            [['CategoryID'], 'required', 'message' => 'Bạn chưa chọn chuyên mục'],
            [['Summary'], 'string', 'max' => 145, 'tooLong' => 'Mô tả không vượt quá 145 kí tự'],
            [['Category'], 'number', 'min' => 1, 'tooSmall' => 'Bạn chưa chọn chuyên mục'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'NewsID' => 'News ID',
            'CategoryID' => 'Category ID',
            'Category' => 'Category',
            'Title' => 'Title',
            'Summary' => 'Summary',
            'Thumbnails' => 'Thumbnails',
            'ThumbnailsPc' => 'Thumbnails Pc',
            'CoverImage' => 'Cover Image',
            'Contents' => 'Contents',
            'ExtendContentMobile' => 'Extend Content Mobile',
            'Keyword' => 'Keyword',
            'Author' => 'Author',
            'Source' => 'Source',
            'ReleaseDate' => 'Release Date',
            'LikeCount' => 'Like Count',
            'ViewCount' => 'View Count',
            'PostCount' => 'Post Count',
            'ThumbnailsDesc' => 'Thumbnails Desc',
            'AudioPath' => 'Audio Path',
            'VideoPath' => 'Video Path',
            'ExtendIsPublic' => 'Extend Is Public',
            'ExtendUserCreate' => 'Extend User Create',
            'ExtendUpdateDate' => 'Extend Update Date',
            'ExtendUpdateTime' => 'Extend Update Time',
            'ExtendHot' => 'Extend Hot',
            'ExtendGet' => 'Extend Get',
            'ExtendVip' => 'Extend Vip',
            'ExtendUserUpdate' => 'Extend User Update',
            'ExtendTop' => 'Extend Top',
            'ExtendUp' => 'Extend Up',
            'ExtendMatchID' => 'Mã trận làm HightLight',
            'ExtendHighLight' => 'Extend High Light',
        ];
    }

}
