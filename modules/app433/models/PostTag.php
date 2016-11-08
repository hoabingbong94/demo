<?php

namespace app\modules\app433\models;

use Yii;

/**
 * This is the model class for table "Post_Tag".
 *
 * @property integer $PostID
 * @property integer $TagID
 */
class PostTag extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Post_Tag';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['PostID', 'TagID'], 'required'],
            [['PostID', 'TagID'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'PostID' => 'Post ID',
            'TagID' => 'Tag ID',
        ];
    }

}
