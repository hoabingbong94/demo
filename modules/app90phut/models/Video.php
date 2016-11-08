<?php

namespace app\modules\app90phut\models;

use Yii;

/**
 * This is the model class for table "Extend_Video".
 *
 * @property integer $ID
 * @property string $EventName
 * @property string $Avatar
 * @property string $AvatarPC
 * @property integer $Minute
 * @property string $UrlVideo
 * @property string $UrlLink
 * @property integer $Type
 * @property integer $TeamID
 * @property string $DateUpdate
 * @property string $DateCreate
 * @property integer $MatchID
 * @property integer $TeamAID
 * @property integer $TeamBID
 * @property integer $LeagueID
 * @property integer $UserID
 * @property integer $Size
 * @property integer $Top
 * @property integer $TopHot
 * @property integer $TopVina
 * @property integer $TopHotVina
 * @property integer $IsPublic
 * @property integer $ViewCount
 * @property integer $Category
 */
class Video extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Extend_Video';
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
            [['Avatar', 'UrlVideo', 'UrlLink'], 'string'],
            [['Minute', 'Type', 'TeamID', 'MatchID', 'TeamAID', 'TeamBID', 'LeagueID', 'UserID', 'Size', 'Top', 'TopHot', 'TopVina', 'TopHotVina', 'IsPublic', 'ViewCount', 'Category'], 'integer'],
            [['LeagueID', 'Category'], 'number', 'min' => 1, 'tooSmall' => 'Bạn chưa chọn chuyên mục'],
            [['EventName'], 'required', 'message' => 'Tiêu đề không được bỏ trống'],
            [['DateUpdate', 'DateCreate'], 'safe'],
            [['EventName'], 'string', 'max' => 150],
            [['AvatarPC'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'EventName' => 'Tiêu đề',
            'Avatar' => 'Ảnh đại diện',
            'AvatarPC' => 'Avatar Pc',
            'Minute' => 'Minute',
            'UrlVideo' => 'Url Video',
            'UrlLink' => 'Url Link',
            'Type' => 'Type',
            'TeamID' => 'Team ID',
            'DateUpdate' => 'Date Update',
            'DateCreate' => 'Date Create',
            'MatchID' => 'Match ID',
            'TeamAID' => 'Team Aid',
            'TeamBID' => 'Team Bid',
            'LeagueID' => 'League ID',
            'UserID' => 'User ID',
            'Size' => 'Size',
            'Top' => 'Top',
            'TopHot' => 'Top Hot',
            'TopVina' => 'Top Vina',
            'TopHotVina' => 'Top Hot Vina',
            'IsPublic' => 'Is Public',
            'ViewCount' => 'View Count',
            'Category' => 'Category',
        ];
    }

}
