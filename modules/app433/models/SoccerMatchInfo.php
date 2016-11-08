<?php

namespace app\modules\app433\models;

use Yii;

/**
 * This is the model class for table "Soccer_Match_Info".
 *
 * @property integer $AwayID
 * @property string $AwayName
 * @property integer $HomeID
 * @property string $HomeName
 * @property integer $MatchID
 * @property string $MatchPeriod
 * @property integer $MatchState
 * @property integer $MinuteEx
 * @property integer $MinutePlaying
 * @property string $Odds
 * @property string $Score
 * @property string $StartTime
 * @property integer $XHAway
 * @property integer $XHHome
 * @property string $AName
 * @property string $BName
 * @property string $CAName
 * @property string $CBName
 * @property string $VName
 * @property integer $LeagueID
 * @property integer $TTUpdateFinishMatch
 * @property integer $ExtendAuto
 */
class SoccerMatchInfo extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Soccer_Match_Info';
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
            [['AwayID', 'HomeID', 'MatchID', 'MatchState', 'MinuteEx', 'MinutePlaying', 'XHAway', 'XHHome', 'LeagueID', 'TTUpdateFinishMatch', 'ExtendAuto'], 'integer'],
            [['MatchID'], 'required'],
            [['StartTime'], 'safe'],
            [['AwayName', 'HomeName'], 'string', 'max' => 150],
            [['MatchPeriod', 'Odds', 'Score', 'AName', 'BName', 'CAName', 'CBName', 'VName'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'AwayID' => 'Away ID',
            'AwayName' => 'Away Name',
            'HomeID' => 'Home ID',
            'HomeName' => 'Home Name',
            'MatchID' => 'Match ID',
            'MatchPeriod' => 'Match Period',
            'MatchState' => 'Match State',
            'MinuteEx' => 'Minute Ex',
            'MinutePlaying' => 'Minute Playing',
            'Odds' => 'Odds',
            'Score' => 'Score',
            'StartTime' => 'Start Time',
            'XHAway' => 'Xhaway',
            'XHHome' => 'Xhhome',
            'AName' => 'Aname',
            'BName' => 'Bname',
            'CAName' => 'Caname',
            'CBName' => 'Cbname',
            'VName' => 'Vname',
            'LeagueID' => 'League ID',
            'TTUpdateFinishMatch' => 'Ttupdate Finish Match',
            'ExtendAuto' => 'Extend Auto',
        ];
    }

}
