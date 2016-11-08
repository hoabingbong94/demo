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
 */
class ExtendMatchTips extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public $pin433;
    public $category433;

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
            [['MatchID', 'Category', 'Hot', 'Vip', 'UserUpdate', 'Free',
            'UserCreate', 'ViewCount', 'category433', 'pin433'], 'integer'],
            [['UpdateDate', 'CreateDate'], 'safe'],
            [['Keyword', 'Author', 'Title', 'Tips', 'Description'], 'string'],
            [['ImageMap'], 'string'],
            [['Image'], 'string'],
            [['Category'], 'number', 'min' => 1, 'tooSmall' => 'Bạn chưa chọn chuyên mục'],
            [['Image'], 'required', 'message' => 'Ảnh đại diện không được bỏ trống'],
            [['ImageMap'], 'required', 'message' => 'Ảnh đội hình không được bỏ trống'],
            [['Title'], 'required', 'message' => 'Tiêu đề không được bỏ trống'],
            [['Description'], 'required', 'message' => 'Mô tả không được bỏ trống'],
            [['Tips'], 'required', 'message' => 'Nội dung không được bỏ trống'],
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
        ];
    }

}
