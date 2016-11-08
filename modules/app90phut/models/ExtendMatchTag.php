<?php

namespace app\modules\app90phut\models;

use Yii;

/**
 * This is the model class for table "Extend_Match_Tag".
 *
 * @property integer $MatchID
 * @property integer $TagID
 */
class ExtendMatchTag extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Extend_Match_Tag';
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
            [['MatchID', 'TagID'], 'required'],
            [['MatchID', 'TagID'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'MatchID' => 'Match ID',
            'TagID' => 'Tag ID',
        ];
    }

}
