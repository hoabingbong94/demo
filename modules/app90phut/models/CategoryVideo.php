<?php

namespace app\modules\app90phut\models;

use Yii;

/**
 * This is the model class for table "Extend_Category_Video".
 *
 * @property integer $ID
 * @property string $Name
 * @property integer $LeagueID
 * @property integer $OrderNumber
 * @property integer $Active
 * @property string $CreateDate
 * @property string $UpdateDate
 */
class CategoryVideo extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Extend_Category_Video';
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
            [['Name', 'LeagueID', 'OrderNumber', 'Active'], 'required'],
            [['LeagueID', 'OrderNumber', 'Active'], 'integer'],
            [['CreateDate', 'UpdateDate'], 'safe'],
            [['Name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'Name' => 'Name',
            'LeagueID' => 'League ID',
            'OrderNumber' => 'Order Number',
            'Active' => 'Active',
            'CreateDate' => 'Create Date',
            'UpdateDate' => 'Update Date',
        ];
    }

}
