<?php

namespace app\modules\app433\models;

use Yii;

/**
 * This is the model class for table "Keywords".
 *
 * @property integer $ID
 * @property string $Keywords
 * @property integer $UserCreate
 * @property integer $UserUpdate
 * @property string $DateCreate
 * @property string $DateUpdate
 * @property integer $Status
 */
class Keywords extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Keywords';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['UserCreate', 'UserUpdate', 'Status'], 'integer'],
            [['DateCreate', 'DateUpdate'], 'safe'],
            [['Keywords'], 'string', 'max' => 400],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'Keywords' => 'Keywords',
            'UserCreate' => 'User Create',
            'UserUpdate' => 'User Update',
            'DateCreate' => 'Date Create',
            'DateUpdate' => 'Date Update',
            'Status' => 'Status',
        ];
    }

}
