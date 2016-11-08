<?php

namespace mdm\admin\models;

use Yii;

/**
 * This is the model class for table "Admin".
 *
 * @property integer $id
 * @property string $username
 * @property string $fullname
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Admin extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Admin_Cms';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username', 'fullname', 'password_hash',], 'required'],
            [['status', 'created_at', 'zoneid', 'updated_at'], 'integer'],
            [['username', 'auth_key'], 'string', 'max' => 32],
            [['fullname'], 'string', 'max' => 50],
            [['username'], 'unique', 'message' => 'Tài khoản đã tồn tại!'],
            [['password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
        ];
    }

    public static function getDb() {
        return Yii::$app->get('db');
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Tên tài khoản',
            'fullname' => 'Họ tên',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Mật khẩu',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'zoneid' => 'Zone',
            'status' => 'Trạng thái',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

}
