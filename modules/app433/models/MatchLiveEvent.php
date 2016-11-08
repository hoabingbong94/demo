<?php

namespace app\modules\app433\models;

use Yii;

/**
 * This is the model class for table "Match_Live_Event".
 *
 * @property integer $ID
 * @property integer $PostID
 * @property string $UrlVideo
 * @property string $UrlVideo144p
 * @property string $Minute
 * @property integer $Type
 * @property string $Content
 * @property string $Token
 * @property integer $UserCreate
 * @property integer $UserUpdate
 * @property string $DateCreate
 * @property string $DateUpdate
 * @property string $Order
 */
class MatchLiveEvent extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Match_Live_Event';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['PostID', 'Type', 'Content'], 'required'],
            [['PostID', 'Type', 'UserCreate', 'UserUpdate'], 'integer'],
            [['Content','Order'], 'string'],
            [['DateCreate', 'DateUpdate'], 'safe'],
            [['UrlVideo', 'UrlVideo144p'], 'string', 'max' => 255],
            [['Minute', 'Token'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'PostID' => 'Post ID',
            'UrlVideo' => 'Url Video',
            'UrlVideo144p' => 'Url Video144p',
            'Minute' => 'Minute',
            'Type' => 'Type',
            'Content' => 'Content',
            'Token' => 'Token',
            'UserCreate' => 'User Create',
            'UserUpdate' => 'User Update',
            'DateCreate' => 'Date Create',
            'DateUpdate' => 'Date Update',
        ];
    }

}
