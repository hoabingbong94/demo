<?php

namespace app\modules\app90phut\models;

use Yii;

/**
 * This is the model class for table "Extend_Star_Tags".
 *
 * @property integer $StarId
 * @property integer $TagId
 */
class StarTags extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Extend_Star_Tags';
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
            [['StarId', 'TagId'], 'required'],
            [['StarId', 'TagId'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'StarId' => 'Star ID',
            'TagId' => 'Tag ID',
        ];
    }

}
