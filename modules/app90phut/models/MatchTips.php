<?php

namespace app\modules\app90phut\models;

use Yii;

/**
 * This is the model class for table "Extend_Match_Tips".
 *
 * @property integer $MatchID
 * @property string $Title
 * @property integer $Category
 * @property string $Tips
 * @property string $Description
 * @property integer $Hot
 * @property string $UpdateDate
 * @property string $Keyword
 * @property string $ImageMap
 * @property string $Author
 * @property integer $Vip
 * @property integer $UserUpdate
 * @property string $CreateDate
 * @property integer $Free
 * @property integer $UserCreate
 * @property string $Image
 * @property integer $ViewCount
 * @property integer $CategoryID
 * @property integer $AllowEdit
 */
class MatchTips extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Extend_Match_Tips';
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
            [['MatchID'], 'required'],
            [['MatchID', 'Category', 'Hot', 'Vip', 'UserUpdate', 'Free', 'UserCreate', 'ViewCount', 'CategoryID', 'AllowEdit'], 'integer'],
            [['Tips'], 'string'],
            [['UpdateDate', 'CreateDate'], 'safe'],
            [['Title', 'Keyword', 'Author'], 'string', 'max' => 255],
            [['Description', 'ImageMap'], 'string', 'max' => 1000],
            [['Image'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'MatchID' => 'Match ID',
            'Title' => 'Title',
            'Category' => 'Category',
            'Tips' => 'Tips',
            'Description' => 'Description',
            'Hot' => 'Hot',
            'UpdateDate' => 'Update Date',
            'Keyword' => 'Keyword',
            'ImageMap' => 'Image Map',
            'Author' => 'Author',
            'Vip' => 'Vip',
            'UserUpdate' => 'User Update',
            'CreateDate' => 'Create Date',
            'Free' => 'Free',
            'UserCreate' => 'User Create',
            'Image' => 'Image',
            'ViewCount' => 'View Count',
            'CategoryID' => 'Category ID',
        ];
    }

}
