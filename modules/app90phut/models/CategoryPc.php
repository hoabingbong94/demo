<?php

namespace app\modules\app90phut\models;

use Yii;

/**
 * This is the model class for table "Extend_Category".
 *
 * @property integer $ID
 * @property string $CategoryName
 * @property integer $ParentID
 * @property integer $OrderIndex
 * @property integer $ShowHome
 * @property integer $ShowNews
 * @property integer $ShowVideo
 * @property integer $Public
 */
class CategoryPc extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Extend_Category';
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
            [['CategoryName', 'ParentID', 'OrderIndex', 'ShowHome', 'ShowNews', 'ShowVideo', 'Public'], 'required'],
            [['ParentID', 'OrderIndex', 'ShowHome', 'ShowNews', 'ShowVideo', 'Public'], 'integer'],
            [['CategoryName'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => 'ID',
            'CategoryName' => 'Category Name',
            'ParentID' => 'Parent ID',
            'OrderIndex' => 'Order Index',
            'ShowHome' => 'Show Home',
            'ShowNews' => 'Show News',
            'ShowVideo' => 'Show Video',
            'Public' => 'Public',
        ];
    }

}
