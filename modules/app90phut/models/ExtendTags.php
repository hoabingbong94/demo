<?php

namespace app\modules\app90phut\models;

use Yii;

/**
 * This is the model class for table "Extend_Tags".
 *
 * @property integer $ID
 * @property string $TagName
 * @property string $Name
 * @property string $CreateDate
 */
class ExtendTags extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Extend_Tags';
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
            [['CreateDate'], 'required'],
            [['CreateDate'], 'safe'],
            [['TagName', 'Name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'TagName' => 'Tag Name',
            'Name' => 'Name',
            'CreateDate' => 'Create Date',
        ];
    }

}
