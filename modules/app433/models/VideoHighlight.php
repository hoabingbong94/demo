<?php

namespace app\modules\app433\models;

use Yii;

/**
 * This is the model class for table "Video_Highlight".
 *
 * @property integer $ID
 * @property string $Title
 * @property string $Avatar
 * @property string $UrlVideo
 * @property integer $PostID
 * @property integer $OrderNumber
 * @property string $CreateDate
 * @property string $UpdateDate
 */
class VideoHighlight extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Video_Highlight';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['PostID', 'OrderNumber'], 'integer'],
            [['CreateDate', 'UpdateDate'], 'safe'],
            [['Title', 'Avatar', 'UrlVideo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'Title' => 'Title',
            'Avatar' => 'Avatar',
            'UrlVideo' => 'Url Video',
            'PostID' => 'Post ID',
            'OrderNumber' => 'Order Number',
            'CreateDate' => 'Create Date',
            'UpdateDate' => 'Update Date',
        ];
    }

}
