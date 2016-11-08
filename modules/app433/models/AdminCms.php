<?php

namespace app\modules\app433\models;

use Yii;

/**
 * This is the model class for table "Admin_Cms".
 *
 * @property integer $id
 * @property string $username
 * @property string $fullname
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property string $auth_key
 * @property integer $created_at
 * @property integer $updated_at
 */
class AdminCms extends \yii\db\ActiveRecord {

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
            [['password_reset_token', 'email', 'auth_key', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash'], 'string', 'max' => 50],
            [['fullname', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'fullname' => 'Fullname',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'auth_key' => 'Auth Key',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

}
