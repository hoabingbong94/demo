<?php

namespace app\modules\app433\models;

use Yii;

/**
 * This is the model class for table "Match_Tips".
 *
 * @property integer $MatchID
 * @property string $Title
 * @property string $Description
 * @property string $Keyword
 * @property string $Tips
 * @property integer $CategoryID
 * @property string $UpdateDate
 * @property integer $UserUpdate
 * @property string $CreateDate
 * @property integer $UserCreate
 * @property string $Image
 * @property string $ImageMap
 * @property integer $Public
 * @property string $Author
 * @property integer $pin
 */
class MatchTips extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Match_Tips';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['MatchID'], 'required'],
            [['MatchID', 'CategoryID', 'UserUpdate', 'UserCreate', 'Public', 'pin'], 'integer'],
            [['Tips', 'Image', 'Description', 'ImageMap', 'Title', 'Keyword', 'Author'], 'string'],
            [['UpdateDate', 'CreateDate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'MatchID' => 'Mã trận đấu',
            'Title' => 'Tiêu đề',
            'Description' => 'Mô tả',
            'Keyword' => 'Từ khóa',
            'Tips' => 'Nội dung',
            'CategoryID' => 'Chuyên mục',
            'UpdateDate' => 'Update Date',
            'UserUpdate' => 'User Update',
            'CreateDate' => 'Create Date',
            'UserCreate' => 'User Create',
            'Image' => 'Ảnh đại diện',
            'ImageMap' => 'Image Map',
            'Public' => 'Hiển thị',
        ];
    }

}
