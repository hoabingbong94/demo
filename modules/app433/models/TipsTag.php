<?php

namespace app\modules\app433\models;

use Yii;

/**
 * This is the model class for table "Tips_Tag".
 *
 * @property integer $MatchId
 * @property integer $TagId
 */
class TipsTag extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Tips_Tag';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['MatchId', 'TagId'], 'required'],
            [['MatchId', 'TagId'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'MatchId' => 'Match ID',
            'TagId' => 'Tag ID',
        ];
    }

}
