<?php

namespace app\modules\app90phut\models;

use Yii;

/**
 * This is the model class for table "Soccer_Team".
 *
 * @property integer $TeamID
 * @property integer $AreaID
 * @property integer $Type
 * @property integer $TeamType
 * @property string $TeamName
 * @property string $OfficialName
 * @property string $ShortName
 * @property string $NameVN
 * @property string $CityID
 * @property string $Address
 * @property string $AddressNumber
 * @property string $AddressExtra
 * @property string $AddressZip
 * @property string $PostalAddress
 * @property string $PostalNumber
 * @property string $PostalExtra
 * @property string $PostalZip
 * @property string $Telephone
 * @property string $Mobile
 * @property string $Fax
 * @property string $Url
 * @property string $Email
 * @property string $Founded
 * @property string $TeamColor
 * @property string $Clothing
 * @property string $Sponsor
 * @property string $Detail
 * @property integer $VenueID
 * @property string $Logo
 * @property integer $Status
 * @property string $TeamCode
 * @property string $TeamCode_2
 * @property string $ServiceId
 * @property string $ProductId
 */
class SoccerTeam extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Soccer_Team';
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
            [['TeamID'], 'required'],
            [['TeamID', 'AreaID', 'Type', 'TeamType', 'VenueID', 'Status'], 'integer'],
            [['Detail'], 'string'],
            [['TeamName'], 'string', 'max' => 100],
            [['OfficialName', 'CityID'], 'string', 'max' => 500],
            [['ShortName', 'NameVN', 'Fax', 'ServiceId', 'ProductId'], 'string', 'max' => 50],
            [['Address', 'AddressNumber', 'AddressExtra', 'AddressZip', 'PostalAddress'], 'string', 'max' => 250],
            [['PostalNumber', 'PostalExtra', 'PostalZip', 'Telephone', 'Mobile', 'Url', 'Email', 'Founded', 'TeamColor', 'Clothing', 'Sponsor', 'Logo', 'TeamCode'], 'string', 'max' => 150],
            [['TeamCode_2'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'TeamID' => 'Team ID',
            'AreaID' => 'Area ID',
            'Type' => 'Type',
            'TeamType' => 'Team Type',
            'TeamName' => 'Team Name',
            'OfficialName' => 'Official Name',
            'ShortName' => 'Short Name',
            'NameVN' => 'Name Vn',
            'CityID' => 'City ID',
            'Address' => 'Address',
            'AddressNumber' => 'Address Number',
            'AddressExtra' => 'Address Extra',
            'AddressZip' => 'Address Zip',
            'PostalAddress' => 'Postal Address',
            'PostalNumber' => 'Postal Number',
            'PostalExtra' => 'Postal Extra',
            'PostalZip' => 'Postal Zip',
            'Telephone' => 'Telephone',
            'Mobile' => 'Mobile',
            'Fax' => 'Fax',
            'Url' => 'Url',
            'Email' => 'Email',
            'Founded' => 'Founded',
            'TeamColor' => 'Team Color',
            'Clothing' => 'Clothing',
            'Sponsor' => 'Sponsor',
            'Detail' => 'Detail',
            'VenueID' => 'Venue ID',
            'Logo' => 'Logo',
            'Status' => 'Status',
            'TeamCode' => 'Team Code',
            'TeamCode_2' => 'Team Code 2',
            'ServiceId' => 'Service ID',
            'ProductId' => 'Product ID',
        ];
    }

}
