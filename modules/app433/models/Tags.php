<?php

namespace app\modules\app433\models;

use Yii;

/**
 * This is the model class for table "Tags".
 *
 * @property integer $ID
 * @property string $TagName
 * @property string $Name
 * @property string $NameAlias
 * @property string $CreateDate
 */
class Tags extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Tags';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['CreateDate'], 'required'],
            [['CreateDate'], 'safe'],
            [['TagName', 'Name'], 'string', 'max' => 50],
            [['NameAlias'], 'string', 'max' => 100],
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
            'NameAlias' => 'Name Alias',
            'CreateDate' => 'Create Date',
        ];
    }

}
